import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../controllers/student_controller.dart';
import '../../../routes/app_pages.dart';

class StudentView extends GetView<StudentController> {
  const StudentView({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    // Ensure the controller is registered
    Get.put(StudentController());

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
                    _buildQuickStats(),
                    const SizedBox(height: 24),
                    _buildSectionTitle("My Tasks"),
                    _buildPendingTasks(),
                    const SizedBox(height: 24),
                    _buildSectionTitle("Today's Timetable"),
                    _buildTimetable(),
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
          BottomNavigationBarItem(icon: Icon(Icons.grade), label: 'Grades'),
          BottomNavigationBarItem(icon: Icon(Icons.person), label: 'Profile'),
        ],
      ),
    );
  }

  Widget _buildHeader() {
    return Container(
      padding: const EdgeInsets.only(left: 20, right: 20, top: 20, bottom: 40),
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
                            "Hello, ${controller.studentName.value}!",
                            style: const TextStyle(
                              color: Colors.white,
                              fontSize: 20,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          Text(
                            controller.grade.value,
                            style: TextStyle(
                              color: Colors.indigo.shade100,
                              fontSize: 14,
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
            mainAxisAlignment: MainAxisAlignment.end,
            children: [
              Container(
                padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                decoration: BoxDecoration(
                  color: Colors.amber.shade400,
                  borderRadius: BorderRadius.circular(20),
                ),
                child: Obx(() => Row(
                      children: [
                        const Text("🏆", style: TextStyle(fontSize: 16)),
                        const SizedBox(width: 4),
                        Text(
                          "${controller.points.value} pts",
                          style: const TextStyle(
                            color: Colors.black87,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ],
                    )),
              ),
            ],
          )
        ],
      ),
    );
  }

  Widget _buildQuickStats() {
    // Use Transform to make the cards overlap the header slightly
    return Transform.translate(
      offset: const Offset(0, -20),
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 20),
        child: Row(
          children: [
            Expanded(
              child: Card(
                elevation: 4,
                shadowColor: Colors.black12,
                shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                child: Padding(
                  padding: const EdgeInsets.symmetric(vertical: 20),
                  child: Column(
                    children: [
                      const Icon(Icons.check_circle_outline, color: Colors.green, size: 32),
                      const SizedBox(height: 8),
                      Obx(() => Text(
                            "${controller.attendance.value}%",
                            style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                          )),
                      const Text("Attendance", style: TextStyle(color: Colors.grey, fontSize: 12)),
                    ],
                  ),
                ),
              ),
            ),
            const SizedBox(width: 16),
            Expanded(
              child: Card(
                elevation: 4,
                shadowColor: Colors.black12,
                shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                child: Padding(
                  padding: const EdgeInsets.symmetric(vertical: 20),
                  child: Column(
                    children: [
                      const Icon(Icons.star_outline, color: Colors.orange, size: 32),
                      const SizedBox(height: 8),
                      Obx(() => Text(
                            "${controller.gpa.value}",
                            style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                          )),
                      const Text("GPA", style: TextStyle(color: Colors.grey, fontSize: 12)),
                    ],
                  ),
                ),
              ),
            ),
          ],
        ),
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

  Widget _buildPendingTasks() {
    return SizedBox(
      height: 165,
      child: Obx(() => ListView.builder(
            scrollDirection: Axis.horizontal,
            padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
            itemCount: controller.pendingTasks.length,
            itemBuilder: (context, index) {
              final task = controller.pendingTasks[index];
              final isCBT = task['type'] == 'CBT Exam';

              return Container(
                width: 240,
                margin: const EdgeInsets.only(right: 16),
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.circular(16),
                  border: isCBT ? Border.all(color: Colors.purple, width: 1.5) : null,
                  boxShadow: const [
                    BoxShadow(color: Colors.black12, blurRadius: 4, offset: Offset(0, 2))
                  ],
                ),
                padding: const EdgeInsets.all(16),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Container(
                          padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                          decoration: BoxDecoration(
                            color: isCBT ? Colors.purple.shade50 : Colors.indigo.shade50,
                            borderRadius: BorderRadius.circular(8),
                          ),
                          child: Text(
                            task['type'],
                            style: TextStyle(
                              color: isCBT ? Colors.purple : Colors.indigo,
                              fontSize: 10,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ),
                        const SizedBox(height: 8),
                        Text(
                          task['title'],
                          style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 15),
                          maxLines: 1,
                          overflow: TextOverflow.ellipsis,
                        ),
                        const SizedBox(height: 4),
                        Row(
                          children: [
                            const Icon(Icons.access_time, size: 14, color: Colors.grey),
                            const SizedBox(width: 4),
                            Text(
                              task['deadline'],
                              style: const TextStyle(color: Colors.grey, fontSize: 12),
                            ),
                          ],
                        ),
                      ],
                    ),
                    if (isCBT)
                      SizedBox(
                        width: double.infinity,
                        height: 32,
                        child: ElevatedButton(
                          onPressed: () {},
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.purple,
                            foregroundColor: Colors.white,
                            shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                          ),
                          child: const Text("Start CBT", style: TextStyle(fontSize: 12)),
                        ),
                      )
                  ],
                ),
              );
            },
          )),
    );
  }

  Widget _buildTimetable() {
    return Obx(() => ListView.builder(
          shrinkWrap: true,
          physics: const NeverScrollableScrollPhysics(),
          padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
          itemCount: controller.todayClasses.length,
          itemBuilder: (context, index) {
            final classInfo = controller.todayClasses[index];
            return Card(
              margin: const EdgeInsets.only(bottom: 12),
              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
              elevation: 2,
              shadowColor: Colors.black12,
              child: ListTile(
                leading: Container(
                  padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                  decoration: BoxDecoration(
                    color: Colors.indigo.shade50,
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Text(
                        classInfo['time']!,
                        style: const TextStyle(
                          color: Colors.indigo,
                          fontWeight: FontWeight.bold,
                          fontSize: 12,
                        ),
                      ),
                    ],
                  ),
                ),
                title: Text(
                  classInfo['subject']!,
                  style: const TextStyle(fontWeight: FontWeight.bold),
                ),
                subtitle: Text(classInfo['teacher']!),
                trailing: const Icon(Icons.chevron_right, color: Colors.grey),
              ),
            );
          },
        ));
  }
}
