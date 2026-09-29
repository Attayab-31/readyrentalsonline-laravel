<!-- resources/views/conversations/print.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation Print</title>
    <!-- Include Bootstrap for styling (optional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0; /* Remove default browser margins */
            padding: 10px; /* Add some space around the content */
        }
        .conversation-container {
            max-width: 95%;
            margin: 0 auto; /* Center the container */
        }
        .chat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .print-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
        }
        .print-btn:hover {
            background-color: #0056b3;
        }
        .message-item {
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 5px;
            line-height: 1.4;
            border: 1px solid #ddd; /* Add a light border for separation */
            position: relative;
        }
        .message-sent {
            background-color: #e8f5ff;
            text-align: right;
        }
        .message-received {
            background-color: #fff3e0;
        }
        .chat-timestamp {
            font-size: 10px;
            color: gray;
            display: block;
        }
        .message-separator {
            border-top: 1px dashed #ccc;
            margin: 10px 0;
        }
        /* Styling for print */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .print-btn {
                display: none; /* Hide the print button */
            }
            .message-item {
                page-break-inside: avoid; /* Prevent messages from splitting across pages */
            }
        }
    </style>
</head>
<body>
    <div class="conversation-container">
        <div class="chat-header">
            <h5>Conversation</h5>
            <button class="print-btn" onclick="window.print()">Print Conversation</button>
        </div>

        <div class="chat-messages">
            @foreach ($messages as $message)
                <div class="message-item {{ $message->sender_id == auth()->id() ? 'message-sent' : 'message-received' }}">
                    <p class="mb-1">{{ $message->message }}</p>
                    <span class="chat-timestamp">
                        <strong>{{ $message->sender->first_name.' '.$message->sender->last_name }}:</strong> 
                        {{ $message->created_at->format('d M Y, h:i A') }}
                    </span>
                </div>
                {{-- @if (!$loop->last)
                    <div class="message-separator"></div>
                @endif --}}
            @endforeach
        </div>
    </div>
</body>
</html>
