function mulaiWaktu() {
    var hariIni = new Date();
    var j = hariIni.getHours();
    var m = hariIni.getMinutes();
    var d = hariIni.getSeconds();
    m = cekWaktu(m);
    d = cekWaktu(d);

    document.getElementById('waktu').innerHTML = j + ":" + m + ":" + d;

    var w = setTimeout(mulaiWaktu, 500);

    let jenis_waktu = document.getElementById('jenis_waktu');

    if(j > 5 && j <= 10) {
        jenis_waktu.innerHTML = "Selamat Pagi!";
    }

    else if(j > 10 && j <= 15) {
        jenis_waktu.innerHTML = "Selamat Siang!";
    }

    else if(j > 15 && j <= 18) {
        jenis_waktu.innerHTML = "Selamat Sore!";
    }

    else if(j > 18 && j <= 19) {
        jenis_waktu.innerHTML = "Selamat Petang!";
    }

    else if (j > 19 && j < 24) {
        jenis_waktu.innerHTML = "Selamat Malam!"
    }

    else if (j > 24 && j < 3) {
        jenis_waktu.innerHTML = "Dini Hari!";
    }
    
    else {
        jenis_waktu.innerHTML = "Waktu Subuh!";
    }

}

function cekWaktu(i) {
    if (i < 10) {
        i = "0" + i
    } 

    return i;
}

function init() {
    mulaiWaktu();
}

