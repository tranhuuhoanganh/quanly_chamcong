
import { defineStore } from "pinia";
import api from '../axios'
export const useAuthStore = defineStore("authStore", {
    state: () => ({
        user: JSON.parse(localStorage.getItem('user'))||null,
    }),
    actions: {
        async fetchUser() {
            try {
                const response = await api.get("get-account-info");
                this.user = response.data.user;
                localStorage.setItem('user', JSON.stringify(response.data.user));
            } catch (error) {
                this.user = null;
                localStorage.removeItem('user');
                console.log(error);
            }
        },
        login() {
            this.fetchUser();
        },

        logout() {
            this.user = null;
            localStorage.removeItem("user");
        }
    }
});