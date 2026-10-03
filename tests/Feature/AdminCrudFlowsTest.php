<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\Property;
use App\Models\PropertyApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AdminCrudFlowsTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        foreach (glob(public_path('resources/files/dynamic/codex-temporary-listing-*.png')) ?: [] as $uploadedFile) {
            unlink($uploadedFile);
        }

        parent::tearDown();
    }

    public function test_admin_can_view_user_profile(): void
    {
        $admin = User::factory()->create(['user_type' => 'superAdmin']);

        $this->actingAs($admin)
            ->get('/accounts/users/'.$admin->id)
            ->assertOk()
            ->assertSee('User profile')
            ->assertSee($admin->email);
    }

    public function test_admin_can_create_update_and_remove_property_user_application_and_invoice_records(): void
    {
        $admin = User::factory()->create(['user_type' => 'superAdmin']);
        $this->actingAs($admin);
        $this->get('/accounts')->assertOk();
        $this->get('/accounts/properties')->assertOk();
        $this->get('/accounts/properties/create')->assertOk()
            ->assertSee('Property Detailed Description')
            ->assertSee('name="p_description"', false);
        $this->get('/accounts/users')->assertOk();
        $this->get('/accounts/users/create')->assertOk();
        $this->get('/accounts/users/'.$admin->id)->assertOk()->assertSee('User profile');
        $this->get('/accounts/invoices')->assertOk();
        $this->get('/accounts/chat')->assertOk();

        $userResponse = $this->post('/accounts/users', [
            'first_name' => 'Temporary',
            'last_name' => 'Tenant',
            'user_type' => 'tenant',
            'account_status' => 'active',
            'email' => 'temporary-tenant@example.test',
            'password' => 'Temporary!5092',
            'confirm_password' => 'Temporary!5092',
        ]);
        $userResponse->assertRedirect('/accounts/users');
        $tenant = User::where('email', 'temporary-tenant@example.test')->firstOrFail();
        $this->get('/accounts/users/'.$tenant->id.'/edit')->assertOk();
        $this->put('/accounts/users/'.$tenant->id, [
            'first_name' => 'Updated',
            'last_name' => 'Tenant',
            'user_type' => 'tenant',
            'account_status' => 'active',
            'email' => 'updated-tenant@example.test',
        ])->assertRedirect('/accounts/users');
        $this->assertDatabaseHas('users', ['id' => $tenant->id, 'first_name' => 'Updated']);
        $this->get('/accounts/invoices/create')->assertOk();

        $propertyResponse = $this->postJson('/accounts/properties', [
            'p_title' => 'Codex Temporary Listing',
            'p_listing_status' => 'for-rent',
            'p_price' => '2450',
            'p_banner_image' => UploadedFile::fake()->createWithContent(
                'temporary-banner.png',
                file_get_contents(public_path('resources/front-end-assets/img/hero-house.png'))
            ),
            'p_address' => '10 Test Street, Newark, NJ 07102',
            'p_short_description' => 'Temporary integration-test listing.',
            'p_description' => 'Temporary listing created and removed by the feature test.',
        ]);
        $propertyResponse->assertOk()->assertJson(['success' => true]);
        $property = Property::where('p_title', 'Codex Temporary Listing')->firstOrFail();
        $uploadedBanner = public_path('resources/files/dynamic/'.$property->p_banner_image);

        $this->get('/properties/explore-details/'.$property->p_slug)->assertOk();
        $this->patch('/accounts/properties/change-active-status/'.$property->property_id.'/inactive')
            ->assertRedirect();
        $this->assertSame('inactive', $property->fresh()->p_active_status);
        $this->patch('/accounts/properties/change-active-status/'.$property->property_id.'/active')
            ->assertRedirect();
        $this->assertSame('active', $property->fresh()->p_active_status);
        $this->get('/accounts/properties/'.$property->property_id.'/edit')->assertOk();
        $this->put('/accounts/properties/'.$property->property_id, [
            'p_title' => 'Codex Temporary Listing Updated',
            'p_listing_status' => 'for-rent',
            'p_price' => '2500',
            'p_address' => '10 Test Street, Newark, NJ 07102',
            'p_short_description' => 'Updated temporary listing.',
            'p_description' => 'Updated temporary listing description.',
        ])->assertJson(['success' => true]);
        $this->assertDatabaseHas('properties', [
            'property_id' => $property->property_id,
            'p_title' => 'Codex Temporary Listing Updated',
            'p_price' => 2500,
        ]);

        $applicationStart = $this->post('/process-online-application', [
            'pa_property_id' => $property->property_id,
            'pa_number_of_co_applicants' => 0,
        ]);
        $applicationStart->assertOk()->assertJsonStructure(['redirect_url']);
        $application = PropertyApplication::where('pa_property_id', $property->property_id)->firstOrFail();
        $this->get($applicationStart->json('redirect_url'))
            ->assertOk()
            ->assertSee('Step 2 of 8')
            ->assertSee('Social Security Number')
            ->assertSee('/online-application/'.$application->pa_tracking_id.'/setup');
        $this->get('/online-application/'.$application->pa_tracking_id.'/setup')
            ->assertOk()
            ->assertSee('Choose a Home and Household Size');
        $this->postJson('/process-online-application/'.$application->pa_tracking_id.'/setup', [
            'pa_property_id' => $property->property_id,
            'pa_number_of_co_applicants' => 1,
        ])->assertOk()->assertJsonStructure(['redirect_url']);
        $this->assertDatabaseHas('property_applications', [
            'property_application_id' => $application->property_application_id,
            'pa_property_id' => $property->property_id,
            'pa_number_of_co_applicants' => 1,
        ]);
        $this->postJson('/process-online-application/'.$application->pa_tracking_id.'/setup', [
            'pa_property_id' => 999999,
            'pa_number_of_co_applicants' => 1,
        ])->assertUnprocessable()->assertJsonValidationErrors(['pa_property_id']);
        $this->postJson('/process-online-application/step-2/'.$application->pa_tracking_id, [
            'pa_applicant_name' => 'Test Applicant',
            'pa_applicant_social_sec_num' => '000000000',
            'pa_applicant_driv_lic_num' => 'TEST1234',
            'pa_applicant_dob' => '1990-01-01',
            'pa_applicant_email' => 'applicant@example.test',
            'pa_applicant_own_or_rent_monthly_payment' => '1200',
            'pa_applicant_phone_num' => '2675499625',
        ])->assertOk()->assertJsonStructure(['redirect_url']);
        $this->get('/online-application/'.$application->pa_tracking_id.'/setup')->assertOk();
        foreach (range(3, 8) as $step) {
            $this->get('/online-application/step-'.$step.'/'.$application->pa_tracking_id)
                ->assertOk()
                ->assertSee('Step '.$step.' of 8');
        }
        $this->get('/online-application/step-9/'.$application->pa_tracking_id)
            ->assertOk()
            ->assertSee('This Step Is Complete')
            ->assertDontSee('/online-application/step-8/'.$application->pa_tracking_id);
        $this->get('/accounts/properties/applications')->assertOk();
        $this->get('/accounts/properties/view-application-details/'.$application->property_application_id)->assertOk();
        $this->delete('/accounts/properties/applications/delete-permanently/'.$application->property_application_id)
            ->assertRedirect();
        $this->assertDatabaseMissing('property_applications', [
            'property_application_id' => $application->property_application_id,
        ]);

        $this->delete('/accounts/properties/delete-property-permanently/'.$property->property_id)
            ->assertRedirect();
        $this->assertDatabaseMissing('properties', ['property_id' => $property->property_id]);
        if (is_file($uploadedBanner)) {
            unlink($uploadedBanner);
        }

        $this->delete('/accounts/users/delete/'.$tenant->id)->assertRedirect('/accounts/users');
        $this->assertSoftDeleted('users', ['id' => $tenant->id]);

        $invoice = Invoice::create([
            'i_tenant_id' => $admin->id,
            'i_issue_date' => '2026-09-30',
            'i_due_date' => '2026-10-15',
            'i_subtotal' => 100,
            'i_tax' => 0,
            'i_total' => 100,
            'i_notes' => 'Temporary integration-test invoice.',
        ]);
        $this->from('/accounts/invoices/create')->post('/accounts/invoices/store', [])->assertSessionHasErrors([
            'i_tenant_id', 'i_issue_date', 'i_due_date', 'i_subtotal', 'i_total',
        ]);
        $this->get('/accounts/invoices/edit/'.$invoice->invoice_id)->assertOk();
        $this->post('/accounts/invoices/update/'.$invoice->invoice_id, [
            'i_tenant_id' => $admin->id,
            'i_issue_date' => '2026-09-30',
            'i_due_date' => '2026-10-20',
            'i_subtotal' => 125,
            'i_tax' => 0,
            'i_total' => 125,
            'i_status' => 'unpaid',
            'i_notes' => 'Updated temporary test invoice.',
        ])->assertRedirect('/accounts/invoices');
        $this->assertDatabaseHas('invoices', [
            'invoice_id' => $invoice->invoice_id,
            'i_total' => 125,
        ]);
        $this->delete('/accounts/invoices/delete/'.$invoice->invoice_id)->assertRedirect('/accounts/invoices');
        $this->assertDatabaseMissing('invoices', ['invoice_id' => $invoice->invoice_id]);
    }
}
