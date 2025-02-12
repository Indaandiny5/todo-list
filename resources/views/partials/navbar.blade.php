<nav class="navbar navbar-expand-lg bg-info navbar-dark fixed-top">
    <div class="container d-flex justify-content-center">
        <a class="navbar-brand fw-bolder" href="#">{{ config('app.name') }}</a>
        {{-- navclass digunakan untuk membungkus tampilan navbar --}}
        {{-- navbar-expand-lg digunakan untuk membuat tampilan navbar menjadi responsive --}}
        {{-- bg-primary digunakan untuk mewarnai background navbar menjadi berwarna biru --}}
        {{-- navbar-dark digunakan untuk membuat teks navbar berwarna hitam --}}
        {{-- fixed-top digunakan untuk membuat tata letak navbar menjadi tetap/diatas --}}
        {{-- untuk memunculkan navbar|class digunakan untuk bootstrap --}}
        {{-- href itu sebuah syntax untuk melink|config('app.name')  akan mengambil nama aplikasi dari file konfigurasi Laravel (config/app.php)  --}}
    </div>
</nav>
