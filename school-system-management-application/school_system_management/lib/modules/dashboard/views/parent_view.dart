import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../controllers/parent_controller.dart';
import '../../../routes/app_pages.dart';

class ParentView extends GetView<ParentController> {
  const ParentView({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Get.put(ParentController());

    return Scaffold(
      backgroundColor: Colors.grey[50],
      appBar: AppBar(
        title: const Text("Parent Portal"),
        backgroundColor: Colors.indigo,
        foregroundColor: Colors.white,
        elevation: 0,
        actions: [
          IconButton(
            icon: const Icon(Icons.notifications),
            onPressed: () {},
          ),
          IconButton(
            icon: const Icon(Icons.logout),
            onPressed: () => Get.offAllNamed(Routes.LOGIN),
          ),
        ],
      ),
      body: SafeArea(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            _buildChildSelector(),
            const SizedBox(height: 16),
            Expanded(
              child: Obx(() {
                // Reactive block: updates entirely when a new child is selected
                final child = controller.activeChild;
                return SingleChildScrollView(
                  padding: const EdgeInsets.symmetric(horizontal: 20),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      _buildProfileCard(child),
                      const SizedBox(height: 16),
                      Row(
                        children: [
                          Expanded(child: _buildAttendanceCard(child)),
                          const SizedBox(width: 16),
                          Expanded(child: _buildFinanceCard(child)),
                        ],
                      ),
                      const SizedBox(height: 24),
                      const Text(
                        "Recent Activity",
                        style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold, color: Colors.indigo),
                      ),
                      const SizedBox(height: 16),
                      _buildActivityTimeline(child),
                      const SizedBox(height: 80), // Padding for FAB
                    ],
                  ),
                );
              }),
            ),
          ],
        ),
      ),
      floatingActionButton: FloatingActionButton.extended(
        onPressed: () {
          Get.snackbar(
            'Message',
            'Opening chat with Homeroom Teacher...',
            snackPosition: SnackPosition.BOTTOM,
            backgroundColor: Colors.indigo,
            colorText: Colors.white,
            margin: const EdgeInsets.all(16),
          );
        },
        backgroundColor: Colors.indigo,
        icon: const Icon(Icons.message, color: Colors.white),
        label: const Text("Contact Teacher", style: TextStyle(color: Colors.white)),
      ),
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: 0,
        selectedItemColor: Colors.indigo,
        unselectedItemColor: Colors.grey,
        type: BottomNavigationBarType.fixed,
        items: const [
          BottomNavigationBarItem(icon: Icon(Icons.home), label: 'Home'),
          BottomNavigationBarItem(icon: Icon(Icons.account_balance_wallet), label: 'Finance'),
          BottomNavigationBarItem(icon: Icon(Icons.message), label: 'Messages'),
          BottomNavigationBarItem(icon: Icon(Icons.person), label: 'Profile'),
        ],
      ),
    );
  }

  Widget _buildChildSelector() {
    return Container(
      color: Colors.indigo,
      padding: const EdgeInsets.only(bottom: 20, left: 20, right: 20),
      child: Obx(() => SingleChildScrollView(
            scrollDirection: Axis.horizontal,
            child: Row(
              children: controller.childrenData.map((child) {
                final isSelected = controller.selectedChildId.value == child['id'];
                return GestureDetector(
                  onTap: () => controller.selectChild(child['id']),
                  child: Container(
                    margin: const EdgeInsets.only(right: 12),
                    padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
                    decoration: BoxDecoration(
                      color: isSelected ? Colors.white : Colors.indigo.shade400,
                      borderRadius: BorderRadius.circular(20),
                      boxShadow: isSelected
                          ? [const BoxShadow(color: Colors.black12, blurRadius: 4, offset: Offset(0, 2))]
                          : null,
                    ),
                    child: Row(
                      children: [
                        CircleAvatar(
                          radius: 12,
                          backgroundColor: isSelected ? Colors.indigo.shade100 : Colors.indigo.shade200,
                          child: Text(
                            child['initials'],
                            style: TextStyle(
                              color: Colors.indigo,
                              fontSize: 10,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ),
                        const SizedBox(width: 8),
                        Text(
                          child['name'].split(' ')[0],
                          style: TextStyle(
                            color: isSelected ? Colors.indigo : Colors.white,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ],
                    ),
                  ),
                );
              }).toList(),
            ),
          )),
    );
  }

  Widget _buildProfileCard(Map<String, dynamic> child) {
    return Card(
      elevation: 2,
      shadowColor: Colors.black12,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
      child: Padding(
        padding: const EdgeInsets.all(20),
        child: Row(
          children: [
            CircleAvatar(
              radius: 30,
              backgroundColor: Colors.indigo.shade50,
              child: Text(
                child['initials'],
                style: const TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: Colors.indigo),
              ),
            ),
            const SizedBox(width: 20),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    child['name'],
                    style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                  ),
                  const SizedBox(height: 4),
                  Text(
                    child['grade'],
                    style: TextStyle(color: Colors.grey[600]),
                  ),
                ],
              ),
            ),
            Column(
              children: [
                const Text("GPA", style: TextStyle(color: Colors.grey, fontSize: 12)),
                Text(
                  "${child['gpa']}",
                  style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold, color: Colors.indigo),
                ),
              ],
            )
          ],
        ),
      ),
    );
  }

  Widget _buildAttendanceCard(Map<String, dynamic> child) {
    final isAbsent = child['attendanceStatus'] == 'Absent';
    return Card(
      elevation: 2,
      shadowColor: Colors.black12,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Row(
              children: [
                Icon(Icons.how_to_reg, color: Colors.grey, size: 16),
                SizedBox(width: 8),
                Text("Attendance", style: TextStyle(color: Colors.grey, fontSize: 12)),
              ],
            ),
            const SizedBox(height: 12),
            Text(
              child['attendanceStatus'],
              style: TextStyle(
                fontSize: 16,
                fontWeight: FontWeight.bold,
                color: isAbsent ? Colors.red : Colors.green,
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildFinanceCard(Map<String, dynamic> child) {
    final hasDebt = child['balance'] > 0;
    return Card(
      elevation: 2,
      shadowColor: Colors.black12,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Row(
              children: [
                Icon(Icons.account_balance_wallet, color: Colors.grey, size: 16),
                SizedBox(width: 8),
                Text("Finance", style: TextStyle(color: Colors.grey, fontSize: 12)),
              ],
            ),
            const SizedBox(height: 12),
            if (hasDebt) ...[
              Text(
                "Outstanding: Rp ${child['balance']}",
                style: const TextStyle(
                  fontSize: 12,
                  fontWeight: FontWeight.bold,
                  color: Colors.red,
                ),
              ),
              const SizedBox(height: 8),
              SizedBox(
                height: 30,
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: () {},
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red,
                    foregroundColor: Colors.white,
                    padding: EdgeInsets.zero,
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                  ),
                  child: const Text("Pay Now", style: TextStyle(fontSize: 12)),
                ),
              )
            ] else ...[
              const Text(
                "Tuition Paid",
                style: TextStyle(
                  fontSize: 14,
                  fontWeight: FontWeight.bold,
                  color: Colors.green,
                ),
              ),
              const SizedBox(height: 8),
              SizedBox(
                height: 30,
                width: double.infinity,
                child: OutlinedButton(
                  onPressed: () {},
                  style: OutlinedButton.styleFrom(
                    foregroundColor: Colors.indigo,
                    padding: EdgeInsets.zero,
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                  ),
                  child: const Text("History", style: TextStyle(fontSize: 12)),
                ),
              )
            ]
          ],
        ),
      ),
    );
  }

  Widget _buildActivityTimeline(Map<String, dynamic> child) {
    final activities = child['recentActivity'] as List<String>;
    return Card(
      elevation: 2,
      shadowColor: Colors.black12,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
      child: ListView.separated(
        shrinkWrap: true,
        physics: const NeverScrollableScrollPhysics(),
        itemCount: activities.length,
        separatorBuilder: (context, index) => const Divider(height: 1),
        itemBuilder: (context, index) {
          final isWarning = activities[index].contains("Due") || activities[index].contains("Missed");
          return ListTile(
            leading: Icon(
              isWarning ? Icons.warning_amber_rounded : Icons.check_circle_outline,
              color: isWarning ? Colors.orange : Colors.green,
            ),
            title: Text(
              activities[index],
              style: const TextStyle(fontSize: 14),
            ),
          );
        },
      ),
    );
  }
}
