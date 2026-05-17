import 'package:get/get.dart';

class ParentController extends GetxController {
  final childrenData = <Map<String, dynamic>>[
    {
      'id': 1,
      'name': 'Ahmad Fauzi',
      'grade': 'Grade 10 - Science',
      'initials': 'AF',
      'gpa': 3.8,
      'attendanceStatus': 'Present',
      'balance': 0,
      'recentActivity': [
        'Math Quiz - 95',
        'Homework Submitted: Physics',
        'Library Book Borrowed'
      ]
    },
    {
      'id': 2,
      'name': 'Siti Aminah',
      'grade': 'Grade 8 - Regular',
      'initials': 'SA',
      'gpa': 3.5,
      'attendanceStatus': 'Absent',
      'balance': 500000,
      'recentActivity': [
        'Tuition Fee Due',
        'History Project Submitted',
        'Missed First Period'
      ]
    }
  ].obs;

  final selectedChildId = 1.obs;

  void selectChild(int id) {
    selectedChildId.value = id;
  }

  Map<String, dynamic> get activeChild {
    return childrenData.firstWhere((child) => child['id'] == selectedChildId.value);
  }
}
