# Exam Fullstack
### 1. Solve Problem
1.1 มีหินอยู่จำนวน N ก้อน แต่ละก้อนสามารถเป็นสีแดง R เขียว G หรือน้ำเงิน B หากนำหินทั้งหมดไปสุ่มวางเรียงกันเป็นแถวเดียว จงหาจำนวนของคู่หินที่มีสีเดียวกันและอยู่ติดกัน
https://jsfiddle.net/tchinlapha/xu40j5r8/28/

1.2 ประเทศ XYZ มีธนบัตรทั้งหมดอยู่ 5 ชนิดคือ 1, 5, 10, 20 และ 100 ลุงพรชัยมีเงินอยู่ในธนาคาร N บาท หากถอนเงินออกมาทั้งหมดจะได้ธนบัตรจำนวนน้อยที่สุดจำนวนเท่าไร
https://jsfiddle.net/tchinlapha/krLn67ht/41/

1.3 * (Optional Test) กิ่งไม้เป็นท่อน
https://jsfiddle.net/tchinlapha/g8upbso0/49/


### 2.1 Back-end Path is Laravel, Database is MySQL
1. Download source code
2. Go to folder backend-laravel
3. Run command for initialize
```sh
composer install
```
4. Create Database in phpMyAdmin and Config DATABASE in ".env.example" file and rename to ".env"
5. Run command for create database tables
```sh
php artisan migrate
```
6. Run command for run project
```sh
php artisan serve
```


### 2.2 Font-end Path is Angular
1. Download source code
2. Go to folder fontend-angular
3. Run command for initialize
```sh
npm install
```
4. Run command for run project
```sh
ng serve --open
```