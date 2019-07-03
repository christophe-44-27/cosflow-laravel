<template>
    <vx-card>
        <vs-table :data="projects">

            <template slot="thead">
                <vs-th>Nom du projet</vs-th>
                <vs-th>Projet public ?</vs-th>
                <vs-th>Date de début</vs-th>
                <vs-th>Avancement</vs-th>
            </template>

            <template slot-scope="{data}">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">

                    <vs-td :data="data[indextr].image_project">
                        {{ data[indextr].image_project }}
                    </vs-td>

                    <vs-td :data="data[indextr].character_name">
                        {{ data[indextr].character_name }}
                    </vs-td>

                    <vs-td :data="data[indextr].serie_name">
                        {{ data[indextr].serie_name }}
                    </vs-td>

                    <vs-td :data="data[indextr].id">
                        {{ data[indextr].id }}
                    </vs-td>

                </vs-tr>
            </template>

        </vs-table>
    </vx-card>
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                projects: []
            }
        },
        created() {
            axios.get('api/projects').then(response => {
                this.projects = response.data.data;
            })
        }
    }
</script>
