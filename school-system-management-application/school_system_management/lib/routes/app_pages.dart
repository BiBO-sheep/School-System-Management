import 'package:get/get.dart';
import '../modules/login/views/login_view.dart';
import '../modules/dashboard/views/student_view.dart';
import '../modules/dashboard/views/teacher_view.dart';
import '../modules/dashboard/views/parent_view.dart';

part 'app_routes.dart';

class AppPages {
  static const INITIAL = Routes.LOGIN;

  static final routes = [
    GetPage(
      name: Routes.LOGIN,
      page: () => LoginView(),
    ),
    GetPage(
      name: Routes.STUDENT_DASHBOARD,
      page: () => const StudentView(),
    ),
    GetPage(
      name: Routes.TEACHER_DASHBOARD,
      page: () => const TeacherView(),
    ),
    GetPage(
      name: Routes.PARENT_DASHBOARD,
      page: () => const ParentView(),
    ),
  ];
}
