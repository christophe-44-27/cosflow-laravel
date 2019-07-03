<template>
    <div class="vx-col w-full mb-base">
        <div class="vx-card">
            <div class="vx-card__header">
                <div class="vx-card__title">
                    <h4 class="">Horizontal Form</h4>
                </div>
            </div>
            <div class="vx-card__body">
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <span>Nom du personnage</span>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input class="w-full" v-bind="character_name"/>
                    </div>
                </div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <span>Référence (Série, Animé, Jeux vidéos, etc.)</span>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input class="w-full" v-bind="serie_name"/>
                    </div>
                </div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <span>Mobile</span>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-upload class="w-full" v-bind="image_project"/>
                    </div>
                </div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <span>Début du projet</span>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <datepicker placeholder="Select Date" v-model="starting_date"></datepicker>
                    </div>
                </div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <span>Fin estimée du projet</span>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <datepicker placeholder="Select Date" v-model="due_date"></datepicker>
                    </div>
                </div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <span>Budget estimé</span>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input class="w-full" v-bind="estimated_budget"/>
                    </div>
                </div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <span>Situation du projet</span>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full ml-auto">
                        <ul class="leftx">
                            <li>
                                <vs-radio v-model="project_situation" vs-value="project_situation">En cours</vs-radio>
                            </li>
                            <li>
                                <vs-radio v-model="project_situation" vs-value="project_situation">Planifié</vs-radio>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <span>Projet privé</span>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-checkbox v-model="is_private">{{checkBox1}}</vs-checkbox>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col sm:w-2/3 w-full ml-auto">
                        <vs-button class="mr-3 mb-2">Submit</vs-button>
                        <vs-button color="warning" type="border" class="mb-2">Reset</vs-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import DateInput from "vuejs-datepicker/src/components/DateInput";
    import Datepicker from 'vuejs-datepicker';
    export default {
        components: {
            DateInput,
            Datepicker
        },
        data(){
            return {
                checkBox1:true,
            }
        }
    }
</script>
