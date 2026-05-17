class ApiConfig {
  // IP Address ini terdeteksi otomatis dari jaringan Wi-Fi kamu saat ini
  static const String ipAddress = "192.168.1.15";
  
  // Base URL untuk API Laravel
  static const String baseUrl = "http://$ipAddress:8000/api";
}
