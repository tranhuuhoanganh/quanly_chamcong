    import { createRouter, createWebHistory } from 'vue-router'

    // Auth
    import Register from '../components/auth/Register.vue'
    import Authenticare from '../components/auth/Authenticare.vue'
    import ResetPassword from '../components/auth/ResetPassword.vue'
    import ForgotPassword from '../components/auth/ForgotPassword.vue'

    // Layout
    import Layout from '../components/member/Layout.vue'

    // Pages
    import Dashboard from '../components/member/Dashboard.vue'
    import Information from '../components/member/Profile/information.vue'
    import ChangePassword from '../components/member/Profile/ChangePassword.vue'
    import Department from '../components/member/Setting/Department/Department.vue'
    import Employee from '../components/member/Setting/Employee/Employee.vue'
    import Role from '../components/member/Setting/Role/Role.vue'
    import Position from '../components/member/Setting/Position/Position.vue'
    import WorkingDay from '../components/member/Setting/Schedule/WorkingDay.vue'
    import Attendance from '../components/member/TimeTracking/Attendance.vue'
    import ListstExpalaination from '../components/member/TimeTracking/Expalaination/list-expalaination.vue'
    import ExplanationApproval from '../components/member/Orders/Explanation-approval.vue';
    const routes = [
        // Auth
        {
            path: '/register',
            component: Register,
            meta: {
                title: 'Register'
            }
        },
        {
            path: '/login',
            component: Authenticare,
            meta: {
                title: 'Login'
            }
        },
        {
            path: '/forgot-password',
            component: ForgotPassword,
            meta: {
                title: 'Forgot Password'
            }
        },
        {
            path: '/reset-password/:token',
            component: ResetPassword,
            meta: {
                title: 'Reset Password'
            }
        },

        // Main Layout
        {
            path: '/',
            component: Layout,
            children: [
                {
                    path: 'dashboard',
                    component: Dashboard,
                    meta: {
                        title: 'Dashboard'
                    }
                },{
                    path: '/profile/information',
                    component: Information,
                    meta: {
                        title: 'Information'
                    }
                },{
                    path: '/profile/change-password',
                    component: ChangePassword,
                    meta: {
                        title: 'Change Password'
                    }
                },{
                    path: '/settings/department',
                    component: Department,
                    meta: {
                        title: 'Department'
                    }
                },{
                    path: '/settings/employee',
                    component: Employee,
                    meta: {
                        title: 'Employee'
                    }
                },{
                    path: '/settings/role',
                    component: Role,
                    meta: {
                        title: 'Vai trò'
                    }
                },{
                    path: '/settings/position',
                    component: Position,
                    meta: {
                        title: 'Chức vụ'
                    }
                },{
                    path: '/settings/working-day',
                    component: WorkingDay,
                    meta: {
                        title: 'Lịch làm việc'
                    }
                },{
                    path: 'timeTracking/attendance',
                    component: Attendance,
                    meta: {
                        title: 'Chấm công'
                    }
                },{
                    path: '/timeTracking/list-expalaination',
                    component: ListstExpalaination,
                    meta: {
                        title: 'Giải trình chấm công'
                    }
                }
                ,{
                    path: '/orders/explanation-approval',
                    component: ExplanationApproval,
                    meta: {
                        title: 'Phê duyệt giải trình'
                    }
                }
            ]
        }
    ]

    const router = createRouter({
        history: createWebHistory(),
        routes,
    })

    export default router
    router.beforeEach((to) => {
        document.title = to.meta.title || '404'
    })