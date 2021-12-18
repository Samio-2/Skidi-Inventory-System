<?php
// session_start();
$conn = mysqli_connect("localhost", "root", "", "persediaan");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//STOK MULAI

//Tambah Stok Mulai
function tambah_stok($data)
{
    global $conn;

    $name = $data["name"];
    $quantity = $data["quantity"];

    $query = "INSERT INTO stok
                VALUES
            ('', '$name', $quantity)                        
            ";
    $result = mysqli_query($conn, $query);
    // var_dump($name);
    // die;
    $pesan = 'Berhasil! Data Berhasil Ditambahkan';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }
    return mysqli_affected_rows($conn);
}
//Tambah Stok Selesai

//Delete Stok Mulai
function delete_stok($id)
{
    global $conn;

    $result = mysqli_query($conn, "DELETE FROM stok WHERE id = $id");

    $pesan = 'Berhasil! Data Berhasil Dihapus';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }
    mysqli_affected_rows($conn);
}
//Delete Stok Selesai

//Ubah Stok Mulai
function ubah_stok($data)
{
    global $conn;

    $id = $data["id"];
    $name = $data["name"];
    $quantity = $data["quantity"];

    $query = " UPDATE stok SET
                name = '$name',
                quantity = $quantity
                WHERE id = $id
            ";
    $result = mysqli_query($conn, $query);

    $pesan = 'Berhasil! Data Berhasil Diubah';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }

    return mysqli_affected_rows($conn);
}
//Ubah Stok Selesai
// STOK SELESAI

//BARANG MASUK MULAI
//Tambah Barang Masuk Mulai
function tambah_barang_masuk($data)
{
    global $conn;

    $id_stok = $data["produk"];
    $vendor = $data["vendor"];
    $quantity = $data["quantity"];
    $date = $data["date"];

    $stok = mysqli_query($conn, "SELECT * FROM stok WHERE id=$id_stok");
    $stk = mysqli_fetch_array($stok);
    $total = $stk['quantity'] + $quantity;

    $query = "INSERT INTO barang_masuk
                VALUES
            ('',$id_stok, '$vendor', $quantity, '$date')                        
            ";
    if ($query) {
        $updatestok = mysqli_query($conn, "UPDATE stok SET quantity =$total WHERE id=$id_stok");
    }
    $result = mysqli_query($conn, $query);
    mysqli_query($conn, $updatestok);

    $pesan = 'Berhasil! Data Berhasil Ditambah';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }

    return mysqli_affected_rows($conn);
}
//Tambah Barang Masuk Selesai

//Delete Barang Masuk Mulai
function delete_barang_masuk($id)
{
    global $conn;

    $dltmsk = mysqli_query($conn, "SELECT id_stok, quantity FROM barang_masuk WHERE id = $id");
    $msk =  mysqli_fetch_array($dltmsk);
    $id_stok = $msk['id_stok'];
    $quantity = $msk['quantity'];

    $stok = mysqli_query($conn, "SELECT * FROM stok WHERE id=$id_stok");
    $stk = mysqli_fetch_array($stok);
    $sisa = $stk['quantity'] - $quantity;

    $delete = mysqli_query($conn, "DELETE FROM barang_masuk WHERE id = $id");

    if ($delete) {
        $result = mysqli_query($conn, "UPDATE stok SET quantity = $sisa WHERE id =$id_stok");
    }

    $pesan = 'Berhasil! Data Berhasil Dihapus';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }

    mysqli_affected_rows($conn);
}
//Delete Barang Masuk Selesai

//Ubah Barang Masuk Mulai
function ubah_barang_masuk($data)
{
    global $conn;

    $id = $data["id"];
    $id_stok = $data["produk"];
    $vendor = $data["vendor"];
    $quantity = $data["quantity"];
    $date = $data["date"];

    //Hapus dulu quantity yg awal
    $dltmsk = mysqli_query($conn, "SELECT id_stok, quantity FROM barang_masuk WHERE id = $id");
    $msk =  mysqli_fetch_array($dltmsk);
    $id_barang = $msk['id_stok'];
    $quantity1 = $msk['quantity'];

    $stok = mysqli_query($conn, "SELECT * FROM stok WHERE id=$id_barang");
    $stk = mysqli_fetch_array($stok);
    $sisa = $stk['quantity'] - $quantity1;

    $stkbrb = mysqli_query($conn, "UPDATE stok SET quantity = $sisa WHERE id =$id_barang");

    //Perubahan di stok

    mysqli_query($conn, $stkbrb);

    if (isset($id_stok)) {
        $query = "UPDATE barang_masuk SET
                id_stok = $id_stok,
                vendor = '$vendor',
                quantity = $quantity,
                date = '$date'
                WHERE id = $id
            ";
    } else {
        $query = "UPDATE barang_masuk SET
            vendor = '$vendor',
            quantity = $quantity,
            date = '$date'
            WHERE id = $id
        ";
    }

    $result = mysqli_query($conn, $query);

    $barang = mysqli_query($conn, "SELECT * FROM barang_masuk WHERE id = $id");
    $brg =  mysqli_fetch_array($barang);
    $id_stk = $brg['id_stok'];

    $stok2 = mysqli_query($conn, "SELECT * FROM stok WHERE id=$id_stk");
    $stk2 = mysqli_fetch_array($stok2);
    $total = $stk2['quantity'] + $quantity;


    if ($query) {
        $updatestok = mysqli_query($conn, "UPDATE stok SET quantity =$total WHERE id=$id_stk");
    }

    mysqli_query($conn, $updatestok);

    $pesan = 'Berhasil! Data Berhasil Diubah';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }

    return mysqli_affected_rows($conn);
}
//Ubah Barang Masuk Selesai
//BARANG MASUK SELESAI

//REQUEST MULAI
//Tambah Request Mulai
function tambah_request($data)
{
    global $conn;

    $id_stok = $data["produk"];
    $deskripsi = $data["deskripsi"];
    $quantity = $data["quantity"];

    $query = "INSERT INTO request
                VALUES
            ('', $id_stok, '$deskripsi', $quantity)                        
            ";
    $result = mysqli_query($conn, $query);
    $pesan = 'Berhasil! Data Berhasil Ditambah';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }
    return mysqli_affected_rows($conn);
}
//Tambah Request Selesai

//Delete Request Mulai
function delete_request($id)
{
    global $conn;

    $result = mysqli_query($conn, "DELETE FROM request WHERE id = $id");
    $pesan = 'Berhasil! Data Berhasil Dihapus';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }
    mysqli_affected_rows($conn);
}
//Delete Request Selesai

//Ubah Request Mulai
function ubah_request($data)
{
    global $conn;

    $id = $data['id'];
    $id_stok = $data["produk"];
    $deskripsi = $data["deskripsi"];
    $quantity = $data["quantity"];

    if (isset($id_stok)) {
        $query = " UPDATE request SET
                id_stok = $id_stok,
                deskripsi = '$deskripsi',
                quantity = $quantity
                WHERE id = $id
            ";
    } else {
        $query = " UPDATE request SET
                deskripsi = '$deskripsi',
                quantity = $quantity
                WHERE id = $id
            ";
    }
    $result = mysqli_query($conn, $query);
    $pesan = 'Berhasil! Data Berhasil Diubah';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }
    return mysqli_affected_rows($conn);
}


//Ubah Request Selesai
//REQUEST SELESAI

//BARANG KELUAR MULAI
//Tambah Barang Keluar Mulai
function tambah_barang_keluar($data)
{
    global $conn;

    $id_stok = $data["produk"];
    $quantity = $data["quantity"];
    $date = $data["date"];

    $stok = mysqli_query($conn, "SELECT * FROM stok WHERE id=$id_stok");
    $stk = mysqli_fetch_array($stok);
    $total = $stk['quantity'] - $quantity;

    if ($stk['quantity'] < $quantity) {

        setcookie("gagal", "Gagal! Jumlah Stok Tidak Mencukupi", time() + 1);
    } else {
        $query = "INSERT INTO barang_keluar
                VALUES
            ('', $id_stok, $quantity, '$date')                        
            ";
    }

    $result = mysqli_query($conn, $query);

    $updatestok = "UPDATE stok SET quantity = $total WHERE id=$id_stok";

    $pesan = 'Berhasil! Data Berhasil Ditambah';
    if ($result) {
        mysqli_query($conn, $updatestok);

        setcookie("sukses", $pesan, time() + 1);
    }
    return mysqli_affected_rows($conn);
}
//Tambah Barang Keluar Selesai

//Delete Barang Keluar Mulai
function delete_barang_keluar($id)
{
    global $conn;

    $dltklr = mysqli_query($conn, "SELECT id_stok, quantity FROM barang_keluar WHERE id = $id");
    $klr =  mysqli_fetch_array($dltklr);
    $id_stok = $klr['id_stok'];
    $quantity = $klr['quantity'];

    $stok = mysqli_query($conn, "SELECT * FROM stok WHERE id=$id_stok");
    $stk = mysqli_fetch_array($stok);
    $sisa = $stk['quantity'] + $quantity;

    $delete = mysqli_query($conn, "DELETE FROM barang_keluar WHERE id = $id");
    if ($delete) {
        $result = mysqli_query($conn, "UPDATE stok SET quantity = $sisa WHERE id =$id_stok");
    }

    $pesan = 'Berhasil! Data Berhasil Dihapus';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }
    mysqli_affected_rows($conn);
}
//Delete Barang Keluar Selesai

//Ubah Barang Keluar Mulai
function ubah_barang_keluar($data)
{
    global $conn;

    $id = $data["id"];
    $id_stok = $data["produk"];
    $quantity = $data["quantity"];
    $date = $data["date"];

    $dltklr = mysqli_query($conn, "SELECT id_stok, quantity FROM barang_keluar WHERE id = $id");
    $klr =  mysqli_fetch_array($dltklr);
    $id_barang = $klr['id_stok'];
    $quantity1 = $klr['quantity'];

    $stok = mysqli_query($conn, "SELECT * FROM stok WHERE id=$id_barang");
    $stk = mysqli_fetch_array($stok);
    $sisa = $stk['quantity'] + $quantity1;

    $stkbrb = "UPDATE stok SET quantity = $sisa WHERE id =$id_barang";
    mysqli_query($conn, $stkbrb);

    if (isset($id_stok)) {
        $cek_stok = mysqli_query($conn, "SELECT * FROM stok WHERE id = $id_stok");
        $cek = mysqli_fetch_array($cek_stok);
        $qty = $cek['quantity'];

        if ($qty >= $quantity) {
            $query = "UPDATE barang_keluar SET
            id_stok = $id_stok,
            quantity = $quantity,
            date = '$date'
            WHERE id = $id
        ";
        } else {
            $gagal = mysqli_query($conn, "SELECT id_stok, quantity FROM barang_keluar WHERE id = $id");
            $ggl =  mysqli_fetch_array($gagal);
            $id_barang = $ggl['id_stok'];
            $quantity1 = $ggl['quantity'];

            $stok = mysqli_query($conn, "SELECT * FROM stok WHERE id=$id_barang");
            $stk = mysqli_fetch_array($stok);
            $sisa = $stk['quantity'] - $quantity1;

            $stkbrb = "UPDATE stok SET quantity = $sisa WHERE id =$id_barang";
            mysqli_query($conn, $stkbrb);
            setcookie("gagal", "Gagal! Jumlah Stok Tidak Mencukupi", time() + 1);
        }
    } else {
        $panggil = mysqli_query($conn, "SELECT * FROM barang_keluar WHERE id = $id");
        $pgl = mysqli_fetch_array($panggil);
        $stok = $pgl['id_stok'];

        $cek_stok = mysqli_query($conn, "SELECT * FROM stok WHERE id = $stok");
        $cek = mysqli_fetch_array($cek_stok);
        $qty = $cek['quantity'];

        if ($qty >= $quantity) {
            $query = " UPDATE barang_keluar SET
                quantity = $quantity,
                date = '$date'
                WHERE id = $id
            ";
        } else {
            $gagal = mysqli_query($conn, "SELECT id_stok, quantity FROM barang_keluar WHERE id = $id");
            $ggl =  mysqli_fetch_array($gagal);
            $id_barang = $ggl['id_stok'];
            $quantity1 = $ggl['quantity'];

            $stok = mysqli_query($conn, "SELECT * FROM stok WHERE id=$id_barang");
            $stk = mysqli_fetch_array($stok);
            $sisa = $stk['quantity'] - $quantity1;

            $stkbrb = "UPDATE stok SET quantity = $sisa WHERE id =$id_barang";
            mysqli_query($conn, $stkbrb);
            setcookie("gagal", "Gagal! Jumlah Stok Tidak Mencukupi", time() + 1);
        }
    }

    $result = mysqli_query($conn, $query);


    $barang = mysqli_query($conn, "SELECT * FROM barang_keluar WHERE id=$id");
    $brg = mysqli_fetch_array($barang);
    $id_stk = $brg['id_stok'];

    $stok2 = mysqli_query($conn, "SELECT * FROM stok WHERE id=$id_stk");
    $stk2 = mysqli_fetch_array($stok2);
    $total = $stk2['quantity'] - $quantity;


    $pesan = 'Berhasil! Data Berhasil Diubah';
    if ($result > 0) {
        mysqli_query($conn, "UPDATE stok SET quantity =$total WHERE id= $id_stk ");
        setcookie("sukses", $pesan, time() + 1);
    }

    return mysqli_affected_rows($conn);
}
//Ubah Barang Keluar Selesai
//BARANG KELUAR SELESAI

//PERMINTAAN MULAI
//Tambah Permintaan Mulai
function tambah_permintaan($data)
{
    global $conn;

    $name = $data["name"];
    $quantity = $data["quantity"];
    $unit = $data["unit"];
    $date = $data["date"];

    $query = "INSERT INTO permintaan
                VALUES
            ('', '$name', $quantity, '$unit', '$date')                        
            ";
    $result = mysqli_query($conn, $query);
    $pesan = 'Berhasil! Data Berhasil Ditambah';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }

    return mysqli_affected_rows($conn);
}
//Tambah Permintaan Selesai

//Delete Permintaan Mulai
function delete_permintaan($id)
{
    global $conn;

    $result = mysqli_query($conn, "DELETE FROM permintaan WHERE id = $id");
    $pesan = 'Berhasil! Data Berhasil Dihapus';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }
    mysqli_affected_rows($conn);
}
//Delete Permintaan Selesai

//Ubah Permintaan Mulai
function ubah_permintaan($data)
{
    global $conn;

    $id = $data["id"];
    $name = $data["name"];
    $quantity = $data["quantity"];
    $unit = $data["unit"];
    $date = $data["date"];

    $query = " UPDATE permintaan SET
                name = '$name',
                quantity = $quantity,
                unit = '$unit',
                date = '$date'
                WHERE id = $id
            ";
    $result = mysqli_query($conn, $query);
    $pesan = 'Berhasil! Data Berhasil Diubah';
    if ($result > 0) {
        setcookie("sukses", $pesan, time() + 1);
    }
    return mysqli_affected_rows($conn);
}
//Ubah Permintaan Selesai
//PERMINTAAN SELESAI

//USER MULAI
//Tambah User Mulai
function tambah_user($data)
{
    global $conn;

    $name = $data["name"];
    $username = $data["username"];
    $email = $data["email"];
    $password = md5($data["password"]);

    $query = "INSERT INTO user
                VALUES
            ('', '$name', '$username', '$email', '$password')                        
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
//Tambah User Selesai

//Cek Login User Mulai
function cek_login($data)
{
    global $conn;

    $username = $data["username"];
    $password = md5($data["password"]);

    $query = " SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        header("Location: index.php");
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
    // return mysqli_affected_rows($conn);
}
//Cek Login User Selesai
//USER SELESAI