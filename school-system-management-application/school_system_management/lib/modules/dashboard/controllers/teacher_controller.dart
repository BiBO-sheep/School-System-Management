import 'package:get/get.dart';

class TeacherController extends GetxController {
  final teacherName = "Mr. Budi Santoso".obs;
  final classesToday = 3.obs;
  final ungradedTasks = 12.obs;

  final todaySchedule = <Map<String, String>>[
    {'time': '08:00 AM', 'subject': 'Mathematics', 'grade': 'Grade 10A', 'room': 'Room 101'},
    {'time': '10:30 AM', 'subject': 'Advanced Math', 'grade': 'Grade 11B', 'room': 'Room 204'},
    {'time': '01:00 PM', 'subject': 'Mathematics', 'grade': 'Grade 10C', 'room': 'Room 103'},
  ].obs;

  final activeTasks = <Map<String, dynamic>>[
    {'title': 'Midterm Physics', 'submitted': 28, 'total': 30},
    {'title': 'Math Chapter 4 Quiz', 'submitted': 30, 'total': 30},
    {'title': 'Weekly Essay', 'submitted': 15, 'total': 30},
  ].obs;
}
