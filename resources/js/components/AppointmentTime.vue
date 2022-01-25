<template>
    <div class="">
        <div class="text-gray-900 py-2 px-3 sm:px-0">
            <div class="font-bold text-uppercase text-center pb-3 px-2">Set Appointment Date And Time For Your Clients</div>
            <div class="flex pb-4 pl-2">
                <input type="datetime-local" :min="disablePastDates()" v-model="appointment" class="bg-gray-200 appearance-none border-2 border-gray-200 shadow-md rounded w-full py-2 px-4 text-blue-800 leading-tight focus:outline-none focus:bg-white border-white">
                <div class="px-4 pt-1">
                    <button @click="addApptDate" class="border-2 border-white bg-gray-200 text-blue-600 rounded-full shadow-md py-1 px-2"><span class="fas fa-plus"></span></button>
                </div>
            </div>
            <div class="overflow-auto h-96">
                <ul class="px-2">
                    <div v-if="apptDates != 0">
                        <div v-for="apptDate in apptDates" :key="apptDate.id">
                            <div class="font-bold py-2">
                                <div class="shadow-md grid grid-cols-2 rounded-xl py-2 px-3">
                                    <li class="inline-block">{{ setDateTime(apptDate.doctor_dates) }}</li>
                                    <div class="text-right">
                                        <span class="fas fa-trash text-right cursor-pointer text-red-700 hover:text-blue-300 transition ease-out duration-500" @click="remove(apptDate)"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="h-48 flex flex-wrap content-center grid justify-items-center">
                            <div class="text-center text-5xl opacity-20">
                                No Appointment Date Added yet
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            user:{
                type: Object,
                required: true
            }
        },

        data(){
            return{
                appointment: "", //Receives strings of date from v-model
                apptDates: []
            }
        },

        mounted(){
            this.getDates(); //Call getDates method
        },

        methods:{
            //Get all user date using the user/doctor id
            getDates(){
                axios.get(`/apptdates/${this.user.user_id}`)
                .then((response) => {
                    this.apptDates = response.data;
                });
            },

            //Limit dates for doctors (Can't choose past dates)
            disablePastDates(){
                let date = new Date(Date.now() + 86400000);
                var limitDate = date.toJSON();
                var legalDateTime = limitDate.split(':')[0];
                var addMinutes = limitDate.split(':')[1];
                return legalDateTime+ ':'+addMinutes;
            },

            //Add date
            addApptDate(){
                //If date is not inserted return, else send and date to backend
                if(this.appointment == 0){
                    return;
                }else{
                    axios.post('/apptdates', {
                        appointment_date: this.appointment
                    }).then((response) => {
                        this.apptDates.push(response.data); //When response is ready, receives it and push to apptDates array
                    })
                }
                this.appointment = ""
            },

            //Delete date
            remove(apptDate){
                axios.delete(`/removeDate/${apptDate.date_id}`)
                .then(() => {
                    this.getDates();
                });
            },

            //Set datetime in string such as (Monday, 24 May 2021)
            setDateTime(datetime){
                let date = new Date(datetime);
                var weekday = date.toLocaleString("en-US", { weekday: 'short' })
                var month = date.toLocaleString("en-US", { month: 'short' })
                var time = date.toLocaleTimeString("en-US")
                return weekday + ', ' + date.getDate() + ' ' + month + ' ' + date.getFullYear() + ' ' + time
            }
        }
    }
</script>

