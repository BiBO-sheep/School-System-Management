import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../controllers/login_controller.dart';

class LoginView extends StatelessWidget {
  LoginView({Key? key}) : super(key: key);

  final LoginController controller = Get.put(LoginController());

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: Center(
          child: SingleChildScrollView(
            padding: const EdgeInsets.symmetric(horizontal: 32.0),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                // EduCore Branding
                const Icon(
                  Icons.school_rounded,
                  size: 100,
                  color: Colors.indigo,
                ),
                const SizedBox(height: 16),
                const Text(
                  "EduCore Mobile",
                  textAlign: TextAlign.center,
                  style: TextStyle(
                    fontSize: 28,
                    fontWeight: FontWeight.bold,
                    color: Colors.indigo,
                  ),
                ),
                const SizedBox(height: 8),
                const Text(
                  "Sign in to your account",
                  textAlign: TextAlign.center,
                  style: TextStyle(
                    fontSize: 16,
                    color: Colors.grey,
                  ),
                ),
                const SizedBox(height: 48),

                // Credential Fields
                TextField(
                  decoration: InputDecoration(
                    labelText: "Email / NIM / NIP",
                    prefixIcon: const Icon(Icons.person_outline),
                    border: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(12),
                    ),
                    enabledBorder: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(12),
                      borderSide: BorderSide(color: Colors.grey.shade300),
                    ),
                  ),
                ),
                const SizedBox(height: 20),
                TextField(
                  obscureText: true,
                  decoration: InputDecoration(
                    labelText: "Password",
                    prefixIcon: const Icon(Icons.lock_outline),
                    border: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(12),
                    ),
                    enabledBorder: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(12),
                      borderSide: BorderSide(color: Colors.grey.shade300),
                    ),
                  ),
                ),
                const SizedBox(height: 40),

                // Role Selection & Loading State
                Obx(() {
                  if (controller.isLoading.value) {
                    return const Center(
                      child: CircularProgressIndicator(
                        valueColor: AlwaysStoppedAnimation<Color>(Colors.indigo),
                      ),
                    );
                  }
                  
                  return Column(
                    crossAxisAlignment: CrossAxisAlignment.stretch,
                    children: [
                      _buildLoginButton(
                        label: "Login as Student",
                        role: 'student',
                        isPrimary: true,
                      ),
                      const SizedBox(height: 12),
                      _buildLoginButton(
                        label: "Login as Teacher",
                        role: 'teacher',
                        isPrimary: false,
                      ),
                      const SizedBox(height: 12),
                      _buildLoginButton(
                        label: "Login as Parent",
                        role: 'parent',
                        isPrimary: false,
                      ),
                    ],
                  );
                }),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildLoginButton({
    required String label,
    required String role,
    required bool isPrimary,
  }) {
    return ElevatedButton(
      onPressed: () => controller.login(role),
      style: ElevatedButton.styleFrom(
        backgroundColor: isPrimary ? Colors.indigo : Colors.indigo.shade50,
        foregroundColor: isPrimary ? Colors.white : Colors.indigo,
        padding: const EdgeInsets.symmetric(vertical: 16),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(12),
        ),
        elevation: 0,
      ),
      child: Text(
        label,
        style: const TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
      ),
    );
  }
}
