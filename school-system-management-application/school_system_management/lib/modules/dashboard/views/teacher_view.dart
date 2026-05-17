import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../controllers/teacher_controller.dart';
import '../../../routes/app_pages.dart';

class TeacherView extends GetView<TeacherController> {
  const TeacherView({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Get.put(TeacherController());

    return Scaffold(
      backgroundColor: Colors.grey[50],
      body: SafeArea(
        child: Column(
          children: [
            _buildHeader(),
            Expanded(
              child: SingleChildScrollView(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const SizedBox(height: 24),
                    _buildQuickActions(),
                    const SizedBox(height: 24),
                    _buildSectionTitle("Active Tasks & Progress"),
                    _buildActiveTasks(),
                    const SizedBox(height: 24),
                    _buildSectionTitle("Today's Schedule"),
                    _buildSchedule(),
                    const SizedBox(height: 24),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: 0,
        selectedItemColor: Colors.indigo,
        unselectedItemColor: Colors.grey,
        type: BottomNavigationBarType.fixed,
        items: const [
          BottomNavigationBarItem(icon: Icon(Icons.home), label: 'Home'),
          BottomNavigationBarItem(icon: Icon(Icons.calendar_today), label: 'Schedule'),
          BottomNavigationBarItem(icon: Icon(Icons.grading), label: 'Grading'),
          BottomNavigationBarItem(icon: Icon(Icons.person), label: 'Profile'),
        ],
      ),
    );
  }

  Widget _buildHeader() {
    return Container(
      padding: const EdgeInsets.all(20),
      decoration: const BoxDecoration(
        color: Colors.indigo,
        borderRadius: BorderRadius.only(
          bottomLeft: Radius.circular(30),
          bottomRight: Radius.circular(30),
        ),
      ),
      child: Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Row(
                children: [
                  const CircleAvatar(
                    radius: 25,
                    backgroundColor: Colors.white,
                    child: Icon(Icons.person, size: 30, color: Colors.indigo),
                  ),
                  const SizedBox(width: 16),
                  Obx(() => Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Welcome back,",
                            style: TextStyle(
                              color: Colors.indigo.shade100,
                              fontSize: 14,
                            ),
                          ),
                          Text(
                            controller.teacherName.value,
                            style: const TextStyle(
                              color: Colors.white,
                              fontSize: 18,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ],
                      )),
                ],
              ),
              IconButton(
                icon: const Icon(Icons.logout, color: Colors.white),
                onPressed: () => Get.offAllNamed(Routes.LOGIN),
              )
            ],
          ),
          const SizedBox(height: 24),
          Row(
            children: [
              Expanded(
                child: Container(
                  padding: const EdgeInsets.symmetric(vertical: 12),
                  decoration: BoxDecoration(
                    color: Colors.indigo.shade400.withOpacity(0.4),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Obx(() => Column(
                        children: [
                          Text(
                            controller.classesToday.value.toString(),
                            style: const TextStyle(
                              color: Colors.white,
                              fontSize: 20,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          const Text(
                            "Classes Today",
                            style: TextStyle(color: Colors.white70, fontSize: 12),
                          ),
                        ],
                      )),
                ),
              ),
              const SizedBox(width: 16),
              Expanded(
                child: Container(
                  padding: const EdgeInsets.symmetric(vertical: 12),
                  decoration: BoxDecoration(
                    color: Colors.indigo.shade400.withOpacity(0.4),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Obx(() => Column(
                        children: [
                          Text(
                            controller.ungradedTasks.value.toString(),
                            style: const TextStyle(
                              color: Colors.white,
                              fontSize: 20,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          const Text(
                            "Ungraded",
                            style: TextStyle(color: Colors.white70, fontSize: 12),
                          ),
                        ],
                      )),
                ),
              ),
            ],
          )
        ],
      ),
    );
  }

  Widget _buildQuickActions() {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          _buildActionIcon(Icons.menu_book, "Material", Colors.blue, () {}),
          _buildActionIcon(Icons.quiz, "Create CBT", Colors.purple, () {
            Get.snackbar(
              'Action',
              'Opening CBT Exam Creator...',
              snackPosition: SnackPosition.BOTTOM,
              backgroundColor: Colors.black87,
              colorText: Colors.white,
              margin: const EdgeInsets.all(16),
            );
          }),
          _buildActionIcon(Icons.edit_document, "Grades", Colors.green, () {}),
          _buildActionIcon(Icons.how_to_reg, "Attendance", Colors.orange, () {}),
        ],
      ),
    );
  }

  Widget _buildActionIcon(IconData icon, String label, Color color, VoidCallback onTap) {
    return GestureDetector(
      onTap: onTap,
      child: Column(
        children: [
          Container(
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              color: color.withOpacity(0.1),
              shape: BoxShape.circle,
            ),
            child: Icon(icon, color: color, size: 28),
          ),
          const SizedBox(height: 8),
          Text(
            label,
            style: const TextStyle(fontSize: 12, fontWeight: FontWeight.bold, color: Colors.black87),
          ),
        ],
      ),
    );
  }

  Widget _buildSectionTitle(String title) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20),
      child: Text(
        title,
        style: const TextStyle(
          fontSize: 18,
          fontWeight: FontWeight.bold,
          color: Colors.indigo,
        ),
      ),
    );
  }

  Widget _buildActiveTasks() {
    return Obx(() => ListView.builder(
          shrinkWrap: true,
          physics: const NeverScrollableScrollPhysics(),
          padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
          itemCount: controller.activeTasks.length,
          itemBuilder: (context, index) {
            final task = controller.activeTasks[index];
            final double progress = task['submitted'] / task['total'];
            final bool isComplete = progress == 1.0;

            return Card(
              margin: const EdgeInsets.only(bottom: 12),
              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
              elevation: 2,
              shadowColor: Colors.black12,
              child: Padding(
                padding: const EdgeInsets.all(16),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        Text(
                          task['title'],
                          style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
                        ),
                        Text(
                          "${task['submitted']}/${task['total']}",
                          style: TextStyle(
                            color: isComplete ? Colors.green : Colors.grey[700],
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 12),
                    ClipRRect(
                      borderRadius: BorderRadius.circular(4),
                      child: LinearProgressIndicator(
                        value: progress,
                        minHeight: 8,
                        backgroundColor: Colors.grey[200],
                        valueColor: AlwaysStoppedAnimation<Color>(
                          isComplete ? Colors.green : Colors.indigo,
                        ),
                      ),
                    ),
                    const SizedBox(height: 8),
                    Text(
                      isComplete ? "All submitted" : "Waiting for submissions",
                      style: TextStyle(fontSize: 12, color: Colors.grey[600]),
                    )
                  ],
                ),
              ),
            );
          },
        ));
  }

  Widget _buildSchedule() {
    return Obx(() => ListView.builder(
          shrinkWrap: true,
          physics: const NeverScrollableScrollPhysics(),
          padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
          itemCount: controller.todaySchedule.length,
          itemBuilder: (context, index) {
            final classInfo = controller.todaySchedule[index];
            return Card(
              margin: const EdgeInsets.only(bottom: 12),
              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
              elevation: 2,
              shadowColor: Colors.black12,
              child: Padding(
                padding: const EdgeInsets.all(12),
                child: Row(
                  children: [
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
                      decoration: BoxDecoration(
                        color: Colors.indigo.shade50,
                        borderRadius: BorderRadius.circular(8),
                      ),
                      child: Text(
                        classInfo['time']!,
                        style: const TextStyle(
                          color: Colors.indigo,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                    const SizedBox(width: 16),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            classInfo['subject']!,
                            style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
                          ),
                          const SizedBox(height: 4),
                          Row(
                            children: [
                              const Icon(Icons.people, size: 14, color: Colors.grey),
                              const SizedBox(width: 4),
                              Text(
                                classInfo['grade']!,
                                style: TextStyle(color: Colors.grey[600], fontSize: 12),
                              ),
                              const SizedBox(width: 12),
                              const Icon(Icons.room, size: 14, color: Colors.grey),
                              const SizedBox(width: 4),
                              Text(
                                classInfo['room']!,
                                style: TextStyle(color: Colors.grey[600], fontSize: 12),
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                    const Icon(Icons.more_vert, color: Colors.grey),
                  ],
                ),
              ),
            );
          },
        ));
  }
}
