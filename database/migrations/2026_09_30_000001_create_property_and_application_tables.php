<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('properties')) {
            Schema::create('properties', function (Blueprint $table) {
                $table->bigIncrements('property_id');
                $table->string('p_title');
                $table->string('p_slug')->nullable()->unique();
                $table->string('p_banner_image')->nullable();
                $table->string('p_address')->nullable();
                $table->string('p_city')->nullable();
                $table->string('p_state')->nullable();
                $table->string('p_zip')->nullable();
                $table->string('p_area')->nullable();
                $table->string('p_rooms')->nullable();
                $table->string('p_baths')->nullable();
                $table->string('p_bedrooms')->nullable();
                $table->string('b_year_built')->nullable();
                $table->string('p_listing_status')->default('for-rent');
                $table->string('p_active_status')->default('active');
                $table->string('p_demo_video')->nullable();
                $table->longText('p_map_location_markup')->nullable();
                $table->decimal('p_price', 12, 2)->nullable();
                $table->text('p_short_description')->nullable();
                $table->longText('p_description')->nullable();
                $table->string('first_name')->nullable();
                $table->string('email')->nullable();
                $table->timestamp('p_created_at')->nullable();
                $table->timestamp('p_updated_at')->nullable();
                $table->index(['p_active_status', 'p_listing_status']);
            });
        }

        if (!Schema::hasTable('property_images')) {
            Schema::create('property_images', function (Blueprint $table) {
                $table->bigIncrements('property_image_id');
                $table->unsignedBigInteger('pi_property_id')->index();
                $table->string('pi_image_name');
                $table->timestamp('pi_created_at')->nullable();
                $table->timestamp('pi_updated_at')->nullable();
            });
        }

        if (!Schema::hasTable('property_amenities')) {
            Schema::create('property_amenities', function (Blueprint $table) {
                $table->bigIncrements('property_amenity_id');
                $table->unsignedBigInteger('pa_property_id')->index();
                $table->string('pa_title');
                $table->timestamp('pa_created_at')->nullable();
                $table->timestamp('pa_updated_at')->nullable();
            });
        }

        if (!Schema::hasTable('property_applications')) {
            Schema::create('property_applications', function (Blueprint $table) {
                $table->bigIncrements('property_application_id');
                $table->unsignedBigInteger('pa_property_id')->nullable()->index();
                $table->string('pa_tracking_id')->nullable()->unique();
                $table->unsignedBigInteger('pa_parent_application_id')->nullable()->index();
                $table->unsignedInteger('pa_number_of_co_applicants')->nullable();
                $table->string('pa_record_type')->nullable()->index();
                $table->string('pa_application_type')->nullable();
                $table->unsignedTinyInteger('pa_current_step')->nullable();
                $table->json('pa_additional_documents')->nullable();
                $table->string('e_sign')->nullable();
                $table->string('co_applicant_e_sign')->nullable();

                $textFields = [
                    'pa_applicant_name', 'pa_applicant_email', 'pa_applicant_phone_num', 'pa_applicant_social_sec_num',
                    'pa_applicant_driv_lic_num', 'pa_applicant_dob', 'pa_applicant_own_or_rent_monthly_payment',
                    'pa_applicant_current_add', 'pa_applicant_current_city', 'pa_applicant_current_state', 'pa_applicant_current_zip',
                    'pa_applicant_previous_add', 'pa_applicant_previous_city', 'pa_applicant_previous_state', 'pa_applicant_previous_zip',
                    'pa_applicant_landlord_name', 'pa_applicant_landlord_phone', 'pa_applicant_reason_for_leaving', 'pa_applicant_have_pets',
                    'pa_applicant_pet_type', 'pa_applicant_bankruptcy', 'pa_applicant_bankruptcy_year', 'pa_applicant_lawsuites',
                    'pa_applicant_lawsuites_year', 'pa_applicant_ever_evicted', 'pa_applicant_eviction_year', 'pa_applicant_felony_conviction',
                    'pa_applicant_felony_conviction_year', 'pa_applicant_judgments_or_fillings', 'pa_applicant_judgments_or_fillings_year',
                    'pa_employer_name', 'pa_employment_length', 'pa_employer_phone', 'pa_employment_position', 'pa_employer_address',
                    'pa_employer_city', 'pa_employer_state', 'pa_employer_zip', 'pa_monthly_income', 'pa_supervisor_name',
                    'pa_supervisor_phone', 'pa_supervisor_fax', 'pa_supervisor_email', 'pa_other_monthly_income',
                    'pa_other_monthly_income_reason', 'pa_emergency_contact_name', 'pa_emergency_contact_phone',
                    'pa_emergency_contact_address', 'pa_emergency_contact_city', 'pa_emergency_contact_state', 'pa_emergency_contact_zip',
                    'pa_is_there_a_coapplicant', 'pa_current_employment_status', 'pa_previous_address_applicable',
                    'pa_co_applicant_name', 'pa_co_applicant_social_sec_num', 'pa_co_applicant_driv_lic_num', 'pa_co_applicant_dob',
                    'pa_co_applicant_email', 'pa_co_applicant_own_or_rent_monthly_payment', 'pa_co_applicant_phone_num',
                    'pa_co_applicant_current_add', 'pa_co_applicant_current_city', 'pa_co_applicant_current_state', 'pa_co_applicant_current_zip',
                    'pa_co_applicant_previous_add', 'pa_co_applicant_previous_city', 'pa_co_applicant_previous_state', 'pa_co_applicant_previous_zip',
                    'pa_co_applicant_landlord_name', 'pa_co_applicant_landlord_phone', 'pa_co_applicant_reason_for_leaving',
                    'pa_co_applicant_have_pets', 'pa_co_applicant_pet_type', 'pa_co_applicant_bankruptcy', 'pa_co_applicant_bankruptcy_year',
                    'pa_co_applicant_lawsuites', 'pa_co_applicant_lawsuites_year', 'pa_co_applicant_ever_evicted', 'pa_co_applicant_eviction_year',
                    'pa_co_applicant_felony_conviction', 'pa_co_applicant_felony_conviction_year', 'pa_co_applicant_judgments_or_fillings',
                    'pa_co_applicant_judgments_or_fillings_year', 'pa_co_applicant_employer_name', 'pa_co_applicant_employment_length',
                    'pa_co_applicant_employer_phone', 'pa_co_applicant_employment_position', 'pa_co_applicant_employer_address',
                    'pa_co_applicant_employer_city', 'pa_co_applicant_employer_state', 'pa_co_applicant_employer_zip',
                    'pa_co_applicant_monthly_income', 'pa_co_applicant_supervisor_name', 'pa_co_applicant_supervisor_phone',
                    'pa_co_applicant_supervisor_fax', 'pa_co_applicant_supervisor_email', 'pa_co_applicant_other_monthly_income',
                    'pa_co_applicant_other_monthly_income_reason', 'pa_co_applicant_emergency_contact_name',
                    'pa_co_applicant_emergency_contact_phone', 'pa_co_applicant_emergency_contact_address',
                    'pa_co_applicant_emergency_contact_city', 'pa_co_applicant_emergency_contact_state', 'pa_co_applicant_emergency_contact_zip',
                    'pa_application_document_attached', 'pa_application_terms_agreement',
                ];

                foreach ($textFields as $field) {
                    $table->text($field)->nullable();
                }

                $table->timestamp('pa_created_at')->nullable();
                $table->timestamp('pa_updated_at')->nullable();
            });
        }

        if (!Schema::hasTable('app_settings')) {
            Schema::create('app_settings', function (Blueprint $table) {
                $table->bigIncrements('app_setting_id');
                foreach ([
                    'as_address', 'as_email', 'as_phone', 'as_fax', 'as_facebook_profile', 'as_instagram_profile',
                    'as_linkedin_profile', 'as_tiktok_profile', 'as_twitter_profile', 'as_youtube_profile',
                    'as_contact_us_email_recipients', 'as_smtp_host', 'as_smtp_security_protocol', 'as_smtp_port',
                    'as_smtp_username', 'as_smtp_password', 'as_smtp_send_from',
                ] as $field) {
                    $table->text($field)->nullable();
                }
                $table->timestamp('as_created_at')->nullable();
                $table->timestamp('as_updated_at')->nullable();
            });
        }

        if (!Schema::hasTable('invoices')) {
            Schema::create('invoices', function (Blueprint $table) {
                $table->bigIncrements('invoice_id');
                $table->unsignedBigInteger('i_tenant_id')->nullable()->index();
                $table->string('i_invoice_number')->unique();
                $table->date('i_issue_date')->nullable();
                $table->date('i_due_date')->nullable();
                $table->string('i_status')->default('unpaid');
                foreach (['i_subtotal', 'i_tax', 'i_total', 'i_amount_paid', 'i_fee', 'i_discount'] as $field) {
                    $table->decimal($field, 12, 2)->default(0);
                }
                $table->text('i_notes')->nullable();
                $table->string('i_payment_method')->nullable();
                $table->string('i_payment_status')->nullable();
                $table->string('i_payment_intent_id')->nullable();
                $table->json('i_payment_metadata')->nullable();
                $table->boolean('i_microdeposit_verified')->default(false);
                $table->timestamp('i_payment_date')->nullable();
                $table->timestamp('i_created_at')->nullable();
                $table->timestamp('i_updated_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('app_settings');
        Schema::dropIfExists('property_applications');
        Schema::dropIfExists('property_amenities');
        Schema::dropIfExists('property_images');
        Schema::dropIfExists('properties');
    }
};
