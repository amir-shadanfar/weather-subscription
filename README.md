# Hediye Kodu ile Hava Durumu Abonelik Sistemi 
 
- Abonelerine günlük hava durumu bilgilerinin gönderildiği bir servis geliştirilmeli. 
- Kullanıcıların bu servise REST API aracılığı kaydedilip günlük hava durumu bilgilerini alabilmeli.
- Bu servise kayıt olan kullanıcıların ücretli abone kabul edilecek, sistemde tanımlı hediye kodları ile kullanıcılar ücretsiz aboneliğe geçebilmeli.
-  Servisin her gün her kullanıcının yerel saatine göre saat 09:00’da o şehirle ilgili hava durumu bilgisini bildirim olarak gönderebilmeli. 
 
### Rest Api 
 
- Kullanıcı kaydı yapılabilmeli (registration) 
-  Kayıtlı kullanıcı login olup auth token alabilmeli, tokenlar 15 dk süreli olmalı (login) 
-  Kayıtlı kullanıcı hediye kodunu aktive edebilmeli (auth token gerektirir) (redeem) 
-  Kayıtlı kullanıcı bilgilerini güncelleyebilir (auth token gerektirir) (update) 
 
### Cron  
Kayıtlı kullanıcılara kendi yerel saat 09'da kendi şehirlerine ait hava durumu gönderilmeli. 

### Beklenenler 
 - Rest api request ve response yapılarının tasarlanması 
 - Gereken veritabanı yapılarının tasarlanması ve sql kodlarının projeye eklenmesi ( MySQL uyumlu ) 
 -  OO ve MVC kod standartlarında geliştirme yapılması 
 - API errorlarının standart yapıda olması, kodda tüm hataların yönetilmesi
 - PSR2 uyumluluğu
 - Açık kaynak kütüphanelerin eklenmesi ve kullanımı 
 - Genel README.md dosyası
 -  Crona eklenecek satır örneği 
 
### Bonus 
 - Docker compose ayarı ve "docker-compose up" ile projenin ayağa kalkması 
 - Git commitleri ve commit mesajları 
 - Kod içerisindeki yorumlar 
 - Rest API best practicelerin uygulanması 
 - Loglama ve hata yakalama 
 -  Behat ve Phpunit ile testlerin yazılması 
 - Rest API versiyon desteği
 -  Phalcon framework kullanımı 
 
### Notlar 
 - Ücretli aboneliklerde ücretlendirme ile ilgili bir şey yapılmayacak. Kullanıcıların default ücretli olduğu kabul edilip bu veritabanında belirtilmeli.
 -  Dünya genelinde 10 tane şehir için günlük hava durumu verilerinin veritabanında olduğu varsayılacak. Şehirler belirlenip dummy veriler eklenebilir. 
 - Kullanıcılara gönderim (mail, bildirim vs.) ile ilgili bir şey yapılmayacak. Gönderimin kodda ilgili yerde yapıldığı varsayılacak. 
- Sistemde 100 adet hediye kodu önceden girilmiş olacak. Her hediye kodu bir kez kullanılabilecek. 
-  Açık kaynak kütüphaneler kullanılabilir. 
 - Saklanacak kullanıcı bilgileri aşağıdaki gibi olmalı:
	 - Email 
	- Şifre 
	- Şehir 
	- Timezone 
	- Dil 
	 - Cihaz 
	- işletim sistemi 
	- Bildirim token 
