<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #10a2a2; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; border-radius: 5px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #10a2a2; }
        .footer { text-align: center; margin-top: 20px; padding: 20px; background: #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Form Message</h1>
        </div>
        
        <div class="content">
            <div class="field">
                <span class="label">From:</span> {{ $name }} ({{ $email }})
            </div>
            
            <div class="field">
                <span class="label">Subject:</span> {{ $subject }}
            </div>
            
            <div class="field">
                <span class="label">Message:</span>
                <div style="margin-top: 10px; padding: 15px; background: white; border-radius: 5px; border-left: 4px solid #10a2a2;">
                    {!! nl2br(e($message)) !!}
                </div>
            </div>
            
            <div class="field">
                <span class="label">Received:</span> {{ $timestamp->format('F j, Y \a\t g:i A') }}
            </div>
        </div>
        
        <div class="footer">
            <p>This email was sent from the contact form on VHGH website.</p>
        </div>
    </div>
</body>
</html>