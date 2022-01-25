<template>
    <div>
        <!-- Appointment Information -->
        <div class="sm:rounded-md">
            <div class="overflow-hidden contain my-2 w-100 md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                <!--- Appointment date and time --->
                <div v-if="success == true">
                    <div class="bg-green-400 text-center font-bold tracking-wider py-1 mb-2">Submitted successfully!!!</div>
                </div>
                <h3 class="morning-hours mb-2">Available Appointment Date and Time</h3>
                <small class="mb-2 pb-2">
                    <span class="text-red-600">{{ errors.dateTime }}</span>
                </small>
                <div class="flex justify-between grid grid-cols-4 md:grid sm:grid-cols-10 gap-2 bg-gray-800 rounded-md p-2">
                    <div class="border-2 rounded-md" v-for="date in appt_dates" :key="date.id">
                        <div class="mb-2 pb-4 overflow-hidden" id="userTime">
                            <input class="" type="radio" v-model="dateTime" :value="date.doctor_dates" :id="date.date_id">
                            <label :for="date.date_id" class="text-gray-100 font-bold cursor-pointer transition rounded-sm pb-1 px-2 ease-out duration-500 absolute">
                                <div class="py-0"><small class="font-bold py-0 pr-2" style="font-size: 8.5px;">{{ getDates(date.doctor_dates) }}</small></div>
                                <small>{{ getTime(date.doctor_dates) }}</small>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group text-xl mt-4">
                    <label for="text" class="text-2xl">Kindly type your problem below:</label>
                    <textarea v-model="issue" id="" cols="20" rows="5" class="form-control text-xl shadow-none focus:outline-none focus:border-blue-400 mt-2"></textarea>
                    <small class="mb-2 pb-2">
                        <span class="text-red-600">{{ errors.issue }}</span>
                    </small>
                </div>
                <div class="form-group my-4">
                    <select v-model="appt_nature" class="form-control text-xl shadow-none focus:outline-none focus:border-blue-400">
                        <option :value="null" disabled hidden style="font-size: 14px;">Select Appointment Nature...</option>
                        <option value="physical">Physical</option>
                        <option value="virtual">Virtual</option>
                    </select>
                    <small class="mb-2 pb-2">
                        <span class="text-red-600">{{ errors.appt_nature }}</span>
                    </small>
                </div>
                <div class="mt-4">
                    <button @click="bookAppt()" type="submit" class="btn btn-sm border-2 shadow-sm border-gray-100 bg-green-600 w-100 text-2xl text-white font-bold font-mono shadow-none focus:outline-none focus:border-blue-400 py-2">Confirm Appointment</button>
                </div>
                <!---/ Appointment date and time --->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            errors: {
                dateTime: "",
                issue: "",
                appt_nature: ""
            },
            
            dateTime: null,
            issue: null,
            appt_nature: null,

            success: false,
            appt_dates: null
        }
    },

    mounted(){
        this.getAppt();
    },

    methods:{
        getAppt(){
            //Get appointment dates from database through laravel controller using axios
            axios.get(`/dates`)
                .then((response) => {
                    this.appt_dates = response.data;
                });
        },

        bookAppt(){
            this.errors = {};
            
            if(this.dateTime == null || this.dateTime == 0){
                this.errors.dateTime = 'Please choose an option.';
            }
            if(this.appt_nature == null || this.appt_nature == 0){
                this.errors.appt_nature = 'This field is required.';
            }
            if (this.issue == null || this.issue == 0) {
                this.errors.issue = 'This field is required.';
            }

            //Convert the error object to array
            var errObj = this.errors;
            var errorArray = Object.keys(errObj);

            //Verify if there's an error using .length
            if(errorArray.length == 0){
                axios.post(`/bookappt/${this.appt_dates[0].user_id}`,{
                    dateTime: this.dateTime,
                    issue: this.issue,
                    appt_nature: this.appt_nature

                }).then(() => {
                    this.resetForm();
                    this.success = true;
                });
            }
        },

        resetForm(){
            this.dateTime = '',
            this.issue = '',
            this.success = false,

            this.errors.dateTime = '',
            this.errors.issue = ''
        },

        /////////// Methods for Visual representation \\\\\\\\\\\\\

        //Show doctor available dates in string
        appointmentDateTime(datetime){
            let date = new Date(datetime);
            var weekday = date.toLocaleString("en-US", { weekday: 'short' })
            var month = date.toLocaleString("en-US", { month: 'short' })
            var time = date.toLocaleTimeString("en-US")
            return weekday + ', ' + date.getDate() + ' ' + month + ' ' + date.getFullYear() + ' / ' + time
        },

        //Show doctor available dates in string
        getDates(datetime){
            let date = new Date(datetime);
            var weekday = date.toLocaleString("en-US", { weekday: 'short' })
            var month = date.toLocaleString("en-US", { month: 'short' })
            return weekday + ', ' + date.getDate() + ' ' + month
        },

        //Specific available doctor time
        getTime(datetime){
            let date = new Date(datetime);
            var time = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });
            return time;
        },

        //Dates disable for birthdays (user can't choose dates higher then their current date as birthday)
        datesLimited(){
            let date = new Date(Date.now() - 86400000);
            var limitDate = date.toJSON();
            return limitDate.split('T')[0];
        }
    }
}
</script>

