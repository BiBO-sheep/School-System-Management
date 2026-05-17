import 'package:get/get.dart';
import '../../../routes/app_pages.dart';

class LoginController extends GetxController {
  final isLoading = false.obs;

  Future<void> login(String role) async {
    isLoading.value = true;
    
    // Simulating network authentication delay
    await Future.delayed(const Duration(seconds: 2));
    
    isLoading.value = false;

    // Route navigation based on selected role
    switch (role) {
      case 'student':
        Get.offAllNamed(Routes.STUDENT_DASHBOARD);
        break;
      case 'teacher':
        Get.offAllNamed(Routes.TEACHER_DASHBOARD);
        break;
      case 'parent':
        Get.offAllNamed(Routes.PARENT_DASHBOARD);
        break;
    }
  }
}
