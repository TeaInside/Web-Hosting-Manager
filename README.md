# Tea Messenger
---
##### Gambaran login :

<p>
<a href="https://ibb.co/cGsuVR"><img src="https://image.ibb.co/gjCuVR/KEREN.png" alt="HASIL" border="0"></a>
</p>

##### Tools :
- Git
- Composer
- Text Editor (Nodepad++,Sublime Text, VSCode, Vim, etc)
- PHP v.7.x
##### Penggunaan / installasi :
- `composer install --verbose`
- `cp .env.example .env`
- sesuaikan konfirmasi database anda
- run service `php icetea serve`

##### Ketentuan Css dan Penulisan Front End
- untuk menambahkan css silahkan taruh sesuai dengan colom komentar
- untuk untuk mohon hapus name css yang tidak terpakai untuk performa app


# Penggunaan Framework :

## Installasi Manual
- Clone terlebih dahulu repo Master Framework Icetea
- Jalan kan `composer install`
- setelah itu copy `.env.example` jadi `.env` dan atur sesuai isi database pada mesin anda

## Local Development Server
Jika anda menginstall PHP secara local dan anda ingin menjalankan sever mode development bawaan php anda bisa menggunakan perintah

`php icetea serve`

dan akan jalan pada pada http://localhost:8001

## Helpers
Icetea Framework dapat menggunaan fungsi global bawaan php, namun Icetea juga mempunya fitur-fitur helper sendiri yang dapat digunakan dalam membangun sebuah aplikasi menggunakan framework Icetea, anda bebas menggunakan untuk kepentingan aplikasi anda.

### Methods yang tersedia antara lain
1. Urls
- asset()
- route()
- $action

### Templating pada Icetea
- `@layout('template')` memanggil file template.tea.php pada directory `app/Views/layouts/`
---
TeamIside
