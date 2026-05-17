import 'package:get/get.dart';

class StudentController extends GetxController {
  final studentName = "Ahmad Fauzi".obs;
  final grade = "Grade 10 - Science".obs;
  final points = 1250.obs;
  final attendance = 98.0.obs;
  final gpa = 3.8.obs;

  final pendingTasks = <Map<String, dynamic>>[
    {
      'title': 'Mathematics Midterm',
      'deadline': 'Tomorrow, 08:00 AM',
      'type': 'CBT Exam'
    },
    {
      'title': 'Physics Lab Report',
      'deadline': 'Friday, 11:59 PM',
      'type': 'Assignment'
    },
    {
      'title': 'English Essay',
      'deadline': 'Next Monday',
      'type': 'Assignment'
    }
  ].obs;

  final todayClasses = <Map<String, String>>[
    {'time': '07:30', 'subject': 'Mathematics', 'teacher': 'Mr. Budi'},
    {'time': '09:00', 'subject': 'Physics', 'teacher': 'Mrs. Sarah'},
    {'time': '10:30', 'subject': 'Break', 'teacher': '-'},
    {'time': '11:00', 'subject': 'Biology', 'teacher': 'Mr. Joko'},
    {'time': '13:00', 'subject': 'English', 'teacher': 'Ms. Emily'},
  ].obs;
}
