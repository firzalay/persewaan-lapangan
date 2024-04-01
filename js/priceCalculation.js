const PRICES_RATES = {
    indoorReguler : 3000000,
    indoorMatras : 250000,
    indoorRumput : 200000,
    outdoorReguler : 250000,
    outdoorMatras : 200000,
    outdoorRumput : 150000,
}

document.getElementById('durasi_sewa').addEventListener('keyup', updatePrice);
document.getElementById('kategori_lapangan').addEventListener('change', updatePrice);
document.getElementById('jenis_lapangan').addEventListener('change', updatePrice);
document.getElementById('sewa_kostum').addEventListener('keyup', updatePrice);
document.getElementById('sewa_sepatu').addEventListener('keyup', updatePrice);
document.getElementById('bayar').addEventListener('keyup', updatePrice);

function updatePrice() {
    let durasi_sewa = document.getElementById('durasi_sewa').value;
    let kategori_lapangan = document.getElementById('kategori_lapangan').value;
    let jenis_lapangan = document.getElementById('jenis_lapangan').value;
    let sewa_kostum = document.getElementById('sewa_kostum').value; 
    let sewa_sepatu = document.getElementById('sewa_sepatu').value;
    let bayar = document.getElementById('bayar').value;

    let totalBayar = 0;
    let basePrice = 0

    if (kategori_lapangan === "Indoor") {
        basePrice = jenis_lapangan === "Reguler" ? PRICES_RATES.indoorReguler : jenis_lapangan === "Matras" ?  PRICES_RATES.indoorMatras 
                                        : PRICES_RATES.indoorRumput;
    } else if (kategori_lapangan === "Outdoor") {
        basePrice = jenis_lapangan === "Reguler" ? PRICES_RATES.outdoorReguler : jenis_lapangan === "Matras" ? PRICES_RATES.outdoorMatras
                                        : PRICES_RATES.outdoorRumput;
    }

    let totalSewaKostum = 45000 * sewa_kostum;
    let totalSewaSepatu = 50000 * sewa_sepatu;

    totalBayar = (durasi_sewa * basePrice) + (durasi_sewa * (totalSewaKostum + totalSewaSepatu));

    document.getElementById('total_bayar').value = totalBayar;

    if (bayar) {
        document.getElementById('uang_kembali').value = bayar - totalBayar;
    }
}