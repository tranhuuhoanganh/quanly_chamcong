<template>
  <aside class="d-flex flex-column p-3 border-end overflow-auto sidebar rounded-4" style=" height: max; width:260px;">
    <!-- Top -->
    <div class="bg-white rounded-4 p-3 border sidebar-top">

      <!-- Logo -->
      <div class="d-flex align-items-center gap-3">
        <div class="d-flex align-items-center justify-content-center text-white logo-icon">
          <i class="fa-regular fa-file-lines fs-5"></i>
        </div>

        <div>
          <h5 class="mb-0 fw-bold text-title">
            QL Văn bản
          </h5>

          <small class="text-muted">
            Đến · Đi · Công việc
          </small>
        </div>
      </div>

    </div>

    <!-- Menu -->
    <nav class="flex-grow-1 mt-3">
      <ul class="nav flex-column">

        <!-- Dashboard -->
        <li class="nav-item mb-1">
          <router-link to="/dashboard"
            class="nav-link d-flex align-items-center gap-2 px-3 sidebar-link rounded-4 fw-bold"
            active-class="active-link">
            <i class="fa-solid fa-table-columns"></i>
            <span>Tổng quan</span>
          </router-link>
        </li>

        <!-- Menu -->
        <li v-for="menu in menus" :key="menu.key" class="mb-1">
          <!-- Parent -->
          <div class="nav-link d-flex justify-content-between align-items-center px-3 sidebar-link rounded-4 "
            role="button" @click="toggleMenu(menu.key)">
            <div class="d-flex align-items-center gap-2">
              <span v-html="menu.icon"></span>
              <span>{{ menu.label }}</span>
            </div>

            <i class="fa-solid fa-angle-down arrow" :class="{ 'rotate-180': activeMenu === menu.key }"></i>
          </div>

          <!-- Child -->
          <ul v-if="activeMenu === menu.key" class="nav flex-column submenu">
            <li v-for="child in menu.children" :key="child.to" class="mb-1">
              <router-link :to="child.to" class="nav-link submenu-link rounded-3" active-class="active-link">
                {{ child.label }}
              </router-link>
            </li>
          </ul>
        </li>
      </ul>
    </nav>

  </aside>
</template>

<style scoped>
.sidebar {
  background: #f8fbfb;
}

/* top */
.sidebar-top {
  border: 1px solid #eef2f7 !important;
}

/* logo */
.logo-icon {
  width: 52px;
  height: 52px;
  border-radius: 16px;
  background: #0f766e;
}

.text-title {
  color: #134e4a;
  font-size: 18px;
}

/* search */
.search-box {
  height: 44px;
  background: #f1f5f9;
}

/* menu */
.sidebar-link {
  height: 48px;
  color: #334155;
  font-size: 15px;
  transition: 0.2s;
}

.sidebar-link:hover {
  background: #edf7f6;
  color: #0f766e;
}

/* active */
.active-link,
.router-link-exact-active {
  background: #edf7f6;
  color: #0f766e !important;
  font-weight: 600;
}

/* submenu */
.submenu {
  margin-left: 12px;
  margin-bottom: 10px;
}

.submenu-link {
  color: #64748b;
  font-size: 14px;
  padding: 8px 12px;
}

.submenu-link:hover {
  background: #f1f5f9;
  color: #0f766e;
}

/* arrow */
.arrow {
  font-size: 12px;
  transition: 0.2s;
}

.rotate-180 {
  transform: rotate(180deg);
}

/* user */
.user-card {
  border: 1px solid #eef2f7 !important;
}

.user-icon {
  width: 44px;
  height: 44px;
  border-radius: 14px;
  color: #0f766e;
}

/* scrollbar */
.sidebar::-webkit-scrollbar {
  width: 4px;
}

.sidebar::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 20px;
}
</style>
<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../../axios";
import { useAuthStore } from "../../stores/authStore";

const router = useRouter();
const authStore = useAuthStore();

const activeMenu = ref(null);

const toggleMenu = (key) => {
  activeMenu.value = activeMenu.value === key ? null : key;
};

const menus = [
  {
    key: "checkin",
    label: "Check In / Check Out",
    icon: `
      <svg width="20" height="20" viewBox="0 0 24 24"
        fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 11V5a3 3 0 0 1 6 0v6" />
        <rect x="5" y="11" width="14" height="10" rx="2" />
      </svg>
    `,
    children: [
      { to: "/timeTracking/attendance", label: "Bảng chấm công" },
      { to: "/timeTracking/list-expalaination", label: "Giải trình" },

    ],
  },

  {
    key: "leave",
    label: "Nghỉ phép",
    icon: `
      <svg width="20" height="20" viewBox="0 0 24 24"
        fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 3c2 2 3 5 3 8s-1 6-3 10c-2-4-3-7-3-10s1-6 3-8z" />
        <path d="M12 7c-2 1-3 2-4 4" />
        <path d="M12 9c2 1 3 2 4 4" />
      </svg>
    `,
    children: [
      { to: "/leave/create-leave", label: "Tạo đơn nghỉ phép" },
      { to: "/leave/annual-leave", label: "Phép năm" },
      { to: "/leave/ot-leave", label: "Phép OT" },
    ]
  },

  {
    key: "order",
    label: "Duyệt đơn",
    icon: `
      <svg width="20" height="20" viewBox="0 0 24 24"
        fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 11l3 3L22 4" />
        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
      </svg>
    `,
    children: [
      { to: "/orders/explanation-approval", label: "Phê duyệt giải trình" },
      { to: "/orders/leave-approval", label: "Phê duyệt nghỉ phép" },
      { to: "/orders/ot-approval", label: "Phê duyệt tăng ca" },

    ],
  },
  {
  key: "salary",
  label: "Lương",
  icon: `
    <svg width="20" height="20" viewBox="0 0 24 24"
      fill="none" stroke="currentColor" stroke-width="2">
      <path d="M12 1v22"/>
      <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14.5a3.5 3.5 0 0 1 0 7H7"/>
    </svg>
  `,
  children: [
    { to: "/salary/payroll", label: "Bảng lương" },
    { to: "/salary/calculate", label: "Tính lương thưởng" },
    { to: "/salary/reward", label: "Thưởng" },
    { to: "/salary/deduction", label: "Khấu trừ" },
  ],
},
  // {
  //   key: "worklog",
  //   label: "Worklog",
  //   icon: `
  //     <svg width="20" height="20" viewBox="0 0 24 24"
  //       fill="none" stroke="currentColor" stroke-width="2">
  //       <path d="M8 2v4" />
  //       <path d="M16 2v4" />
  //       <rect x="3" y="4" width="18" height="18" rx="2" />
  //       <path d="M3 10h18" />
  //     </svg>
  //   `,
  //   children: [
  //     { to: "/worklogs/explanation", label: "Giải trình chấm công" },
  //     { to: "/worklogs/leave", label: "Nghỉ phép" },
  //   ],
  // },

  {
    key: "setting",
    label: "Cấu hình",
    icon: `
      <svg width="20" height="20" viewBox="0 0 24 24"
        fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="3" />
        <path
          d="M19.4 15a1 1 0 0 0 .2 1.1l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1 1 0 0 0-1.1-.2 1 1 0 0 0-.6.9V20a2 2 0 1 1-4 0v-.2a1 1 0 0 0-.6-.9 1 1 0 0 0-1.1.2l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1 1 0 0 0 .2-1.1 1 1 0 0 0-.9-.6H4a2 2 0 1 1 0-4h.2a1 1 0 0 0 .9-.6 1 1 0 0 0-.2-1.1l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1 1 0 0 0 1.1.2h.2a1 1 0 0 0 .6-.9V4a2 2 0 1 1 4 0v.2a1 1 0 0 0 .6.9 1 1 0 0 0 1.1-.2l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1 1 0 0 0-.2 1.1v.2a1 1 0 0 0 .9.6H20a2 2 0 1 1 0 4h-.2a1 1 0 0 0-.9.6z">
        </path>
      </svg>
    `,
    children: [
      { to: "/settings/department", label: "Phòng ban" },
      { to: "/settings/employee", label: "Nhân sự" },
      { to: "/settings/position", label: "Chức vụ" },
      { to: "/settings/role", label: "Vai trò" },
      { to: "/settings/working-day", label: "Lịch làm việc" },
    ],
  },

  {
    key: "report",
    label: "Báo cáo",
    icon: `
      <svg width="20" height="20" viewBox="0 0 24 24"
        fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="20" x2="18" y2="10"></line>
        <line x1="12" y1="20" x2="12" y2="4"></line>
        <line x1="6" y1="20" x2="6" y2="14"></line>
      </svg>
    `,
    children: [
      { to: "/reports/daily-attendance", label: "Chấm công ngày" },
      { to: "/reports/monthly-attendance", label: "Chấm công tháng" },
    ],
  },
  {
    key: "profile",
    label: "Profile",
    icon: `<i class="fa-solid fa-user"></i></span>`,
    children: [
      { to: "/profile/information", label: "Thông tin cá nhân" },
      { to: "/profile/change-password", label: "Đổi mật khẩu" },
    ],
  },
];

const logout = async () => {
  try {
    await api.get("logout");

    localStorage.removeItem("token");

    authStore.logout();

    router.push("/login");
  } catch (err) {
    console.log(err);
  }
};
</script>
