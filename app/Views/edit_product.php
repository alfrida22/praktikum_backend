<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<form method="POST" action="<?=base_url('update-product/'.$product->id)?>">
        <label for="nama_product">Nama Produk</label>
        <input id="nama_product" name="nama_product" value="<?= $product->nama_product ?>" type="text" />
        <label for="deskripsi_product">Deskripsi Produk</label>
        <input id="description" name="description" value="<?= $product->description ?>" type="text" />
        <button type="submit">Update</button>
    </form>
</body>
</html>