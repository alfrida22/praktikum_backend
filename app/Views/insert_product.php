<!DOCTYPE html>
<html>
<head>
    <title>Form Insert Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 15px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #555;
            color: #fff;
            border: none;
            padding: 10px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <h2>Insert Product</h2>
    <form method="post" action="<?php echo base_url('insertproducts'); ?>">
        <label for="nama_product">Nama Product</label>
        <input type="text" id="nama_product" name="nama_product" required>
        <br><br>
        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" required></textarea>
        <br><br>
        <input type="submit" value="Tambahkan">
    </form>
</body>
</html>
