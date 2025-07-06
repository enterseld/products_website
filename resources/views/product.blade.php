<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    @vite('resources/js/app.js')
</head>
<body>
    <div id="app">
        <product :initial-vendor-code="'{{ $vendor_code }}'" :initial-category-id="'{{ $category_id }}'"></product>
    </div>
</body>
</html>
