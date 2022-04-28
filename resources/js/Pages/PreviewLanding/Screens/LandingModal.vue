<template>
    <div class="text-center my-8">
        <button type="button" class="btn bg-black rounded-[2rem] px-8" @click="showModal()">
            <span class="uppercase text-white font-black text-xl">Buy</span>
        </button>
    </div>
    <!-- If the option changed modal component the name
    <modal>
    -->
    <modal
        v-model="isShow"
        :close="closeModal"
    >
        <div class="bg-white w-screen h-screen md:w-[60%] md:h-[100%]">
            <div class="w-full flex flex-col md:flex-row">
                <div class="hidden md:flex md:w-[25%] md:flex-row h-full opacity-50">
                    <div class="-rotate-180 w-full h-[75%] text-left font-black" :style="{ writingMode: 'vertical-rl' }"><p class="text-secondary-50 text-9xl m-0 p-0 font-bold">Thank You</p></div>
                    <div class="-rotate-180 w-full text-left font-black mb-20" :style="{ writingMode: 'vertical-rl' }"><p class="text-secondary-50 text-7xl m-0 p-0 -leading-tight font-bold">from Lave.</p></div>
                </div>
                <div class="mx-12 md:mx-8 mt-12 flex flex-col md:w-[50%]">
                    <div class="text-right" id="closeMe"><button type="button" @click="closeModal"> <span class="text-lg text-black hover:text-info"> X </span></button></div>
                    <div class="pb-4" id="titleLine"><h1 class="text-4xl font-black text-black tracking-wide font-bold">Our Serum and Moisturizer Products</h1></div>
                    <div class="py-4" id="description"><p class="text-xl text-black font-bold">Here's some lorem ipsum. Now some more lorem ipsum. Here is a bit more lorem ipsum. Lorem Ipsum for days. All of the lorem ipsum. Plenty of lorem ipsum. Lorem ipsum lorem ipsum. Oh, my  lorem ipsum. Lorem Ipsum, Lorem Ipsum, wherefore art thou Lorem Ipsum? Dolores.</p></div>
                    <div class="py-4" id="theForm">
                        <form class="w-full">
                            <input type="text" class="form-control w-full bg-white border-primary rounded-[5px] my-4 text-black" v-model="form.firstName" placeholder="| FIRST NAME"/>
                            <input type="text" class="form-control w-full bg-white border-primary rounded-[5px] my-4 text-black" v-model="form.lastName" placeholder="| LAST NAME"/>
                            <input type="email" class="form-control w-full bg-white border-primary rounded-[5px] my-4 text-black" v-model="form.email" placeholder="| EMAIL"/>
                            <input type="text" class="form-control w-full bg-white border-primary rounded-[5px] my-4 text-black" v-model="form.phone" placeholder="| PHONE NUMBER"/>
                            <div class="text-center"> <input type="checkbox" class="checkbox checkbox-sm border-black border-2 rounded-[0px]" v-model="form.consent" /> <small class="ml-2 text-neutral">I have accepted the Terms and Conditions</small></div>
                            <div class="text-center my-8"> <button type="button" class="btn bg-black rounded-[2rem] px-8" @click="submitForm()" :disabled="loading"><span class="uppercase text-white font-black text-xl">{{ submitBtnText }}</span></button></div>
                        </form>
                    </div>

                </div>
                <div class="md:w-[20%] h-[100%] md:h-full border-t border-t-base-100 flex justify-center" id="aLineOfPics66PercentCutOff">
                    <p class="md:hidden text-center text-black mt-12 text-xl"> The pics go in a row here </p>
                    <p class="hidden md:flex text-center text-black text-2xl md:mt-64"> The <br />pics <br />go <br />in <br />a <br />column <br />here </p>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
import ModalComponent from "@/Components/ModalComponent";
export default {
    name: "LandingModal",
    components: {ModalComponent},
    component: {
        ModalComponent
    },
    props: ['id'],
    data() {
        return {
            loading: false,
            isShow: false,
            form: {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                consent: ''
            },
        };
    },
    computed: {
        submitBtnText() {
            return this.loading ? 'Loading...' : 'Submit'
        },
        validateForm() {
            let results = true;

            for(let field in this.form) {
                if(this.form[field] === '') {
                    results = field;
                    break;
                }
                else if((field === 'consent') && (!this.form.consent)) {
                    results = field;
                    break;
                }
            }

            return results;
        }
    },
    methods: {
        showModal() {
            this.$emit('clicked');
            this.isShow = true;
        },
        closeModal() {
            this.isShow = false;
        },
        submitForm() {
            switch(this.validateForm) {
                case 'firstName':
                    new Noty({
                        theme: 'lave',
                        type: 'warning',
                        layout: 'center',
                        text: 'First Name is required!',
                        timeout: 700
                    }).show();
                    break;
                case 'lastName':
                    new Noty({
                        theme: 'lave',
                        type: 'warning',
                        layout: 'center',
                        text: 'Last Name is required!',
                        timeout: 700
                    }).show();
                    break;
                case 'email':
                    new Noty({
                        theme: 'lave',
                        type: 'warning',
                        layout: 'center',
                        text: 'Email Address is required!',
                        timeout: 700
                    }).show();
                    break;
                case 'phone':
                    new Noty({
                        theme: 'lave',
                        type: 'warning',
                        layout: 'center',
                        text: 'Phone Number is required!',
                        timeout: 700
                    }).show();
                    break;
                case 'consent':
                    new Noty({
                        theme: 'lave',
                        type: 'warning',
                        layout: 'center',
                        text: 'Consent of the T&C is required!',
                        timeout: 700
                    }).show();
                    break;

                default:
                    this.loading = true;
                    this.postForm();
            }
        },
        postForm() {
            let _this = this;
            let payload = this.form;
            payload['type'] = 'landing';
            if(analytics !== undefined) {
                payload['anonymous_id'] = analytics.user().anonymousId()
            }

            axios.post('/customer/lead', payload)
                .then(({ data }) => {
                    new Noty({
                        theme: 'lave',
                        type: 'success',
                        text: "Congrats We've received your request! We will reach out to you ASAP!",
                        timeout: 7000
                    }).show();

                    if(analytics !== undefined) {
                        analytics.identify(data['id'], _this.form);
                        let u = _this.form;
                        u['location'] = 'Landing Page';
                        analytics.track('Lead Captured', u);
                    }
                    _this.loading = false;
                    _this.form = {
                        firstName: '',
                        lastName: '',
                        email: '',
                        phone: '',
                        consent: ''
                    }
                    _this.closeModal();
                })
                .catch(({ response }) => {
                        console.log('Fuck you', response);
                        let data = null;
                        let reason = null;

                        switch(response.status) {
                            case 404:
                                new Noty({
                                    theme: 'lave',
                                    type: 'error',
                                    text: 'Ooops, the server is saying the URL to send your request to does not exist! Maybe try again later.',
                                    layout: 'center',
                                    timeout: 7000
                                }).show();
                                break;

                            case 422:
                                data = response.data;
                                reason = ('message' in data) ? data['message'] : `${response.statusText} occurred. Try Again Later.`
                                new Noty({
                                    theme: 'lave',
                                    type: 'warning',
                                    text: 'Ooops, '+reason,
                                    layout: 'center',
                                    timeout: 7000
                                }).show();
                                break;

                            case 500:
                                data = response.data;
                                reason = ('reason' in data) ? data['reason'] : `${response.statusText} occurred. Try Again Later.`
                                new Noty({
                                    theme: 'lave',
                                    type: 'error',
                                    text: 'Ooops, '+reason,
                                    layout: 'center',
                                    timeout: 7000
                                }).show();
                                break;
                        }
                        _this.loading = false;
                })
        }
    }
}
</script>

<style scoped lang="scss">
.modal {
    width: 300px;
    padding: 30px;
    box-sizing: border-box;
    background-color: #fff;
    font-size: 20px;
    text-align: center;
}
</style>
