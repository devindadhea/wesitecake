<!DOCTYPE html>
<html>
<head>
    <title>Test Upload Laravel</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { max-width: 500px; margin: 0 auto; }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #C2185B; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Test Upload Category (Laravel)</h2>
    
    <form method="POST" action="{{ url('/test-upload') }}" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="Test Category {{ date('Y-m-d H:i:s') }}" required>
        </div>
        
        <div>
            <label>Image (max 2MB):</label>
            <input type="file" name="image" accept="image/*" required>
        </div>
        
        <div>
            <label>Description:</label>
            <textarea name="description">Test description</textarea>
        </div>
        
        <div>
            <label>Order:</label>
            <input type="number" name="order" value="5">
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="is_active" value="1" checked>
                Active
            </label>
        </div>
        
        <button type="submit">Submit Test</button>
    </form>
    
    <hr>
    
    <h3>Info Penting:</h3>
    <ul>
        <li>CSRF Token: {{ csrf_token() }}</li>
        <li>Session ID: {{ session()->getId() }}</li>
        <li>URL Form Action: {{ url('/test-upload') }}</li>
    </ul>
</body>
</html>