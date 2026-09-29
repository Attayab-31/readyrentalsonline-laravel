<!DOCTYPE html>
<html>
<head>
    <title>Property Shared With You</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .property-card { 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            overflow: hidden; 
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .property-image { 
            width: 100%; 
            height: auto;
            max-height: 300px;
            object-fit: cover;
        }
        .property-details { 
            padding: 20px; 
        }
        .property-title { 
            font-size: 20px; 
            font-weight: bold; 
            margin-bottom: 10px;
            color: #333;
        }
        .property-address {
            color: #666;
            margin-bottom: 10px;
        }
        .property-price { 
            color: #2a6496; 
            font-weight: bold; 
            margin: 10px 0; 
            font-size: 18px;
        }
        .sender-message { 
            background-color: #f9f9f9; 
            padding: 15px; 
            border-radius: 5px; 
            margin: 15px 0;
            border-left: 4px solid #2a6496;
        }
        .btn-view { 
            display: inline-block; 
            padding: 12px 24px; 
            background: #2a6496; 
            color: white !important; 
            text-decoration: none; 
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            margin-top: 15px;
        }
        .footer-text {
            text-align: center; 
            margin-top: 20px; 
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="property-card">
            <img src="{{ $property_image }}" alt="{{ $property_title }}" class="property-image">
            <div class="property-details">
                <div class="property-title">{{ $property_title }}</div>
                <div class="property-address">{{ $property_address }}</div>
                <div class="property-price">${{ number_format($property_price, 2) }}</div>
                
                @if($message)
                <div class="sender-message">
                    <strong>Message from {{ $sender_name }}:</strong>
                    <p>{{ $message }}</p>
                </div>
                @endif
                
                <a href="{{ $property_url }}" class="btn-view" style="color: white;">View Property</a>
            </div>
        </div>
        
        <p class="footer-text">
            This property was shared with you by {{ $sender_name }} via Ready Rentals Online.
        </p>
    </div>
</body>
</html>