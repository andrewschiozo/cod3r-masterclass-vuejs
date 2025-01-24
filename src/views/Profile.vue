<style scoped>
    .componente {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    table {
        border-collapse: collapse;
        width: 60%;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    table tr th, table tr td {
        width: 50%;
        text-align: left;
        padding: 5px 5px;
        border: 2px solid #FFF;
    }
    table tr td {
        color: #0e7e28;
    }
</style>

<template>
    <div class="componente">
        <h1>Profile</h1>
        <table>
            <tr>
                <th>Firsname</th>
                <td>{{auth.userData.firstName}}</td>
            </tr>
            <tr>
                <th>Lastname</th>
                <td>{{auth.userData.lastName}}</td>
            </tr>
            <tr>
                <th>Birth</th>
                <td>{{auth.userData.birthday}}</td>
            </tr>
            <tr>
                <th>Age</th>
                <td>{{ age }}</td>
            </tr>
            <tr>
                <th>Roles</th>
                <td>{{ roles }}</td>
            </tr>
        </table>
    </div>
</template>

<script setup>
    import { useAuth } from '@/stores/auth';
    import { computed } from 'vue'

    const age = computed(() => {
        const birthDate = new Date(auth.userData.birthday)
        const today = new Date()
        let years = today.getFullYear() - birthDate.getFullYear()
        let months = today.getMonth() - birthDate.getMonth()
        let days = today.getDate() - birthDate.getDate()
        if (days < 0) {
            months--
            const monthDays = new Date(today.getFullYear(), today.getMonth(), 0).getDate()
            days += monthDays
        }
        if (months < 0) {
            years--
            months = 11
        }
        return `${years} anos, ${months} meses e ${days} dias`
    })

    const roles = computed(() => {
        return auth.userData.profile.join(', ')
    })

    const auth = useAuth()


</script>