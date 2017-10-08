import AppForm from '../components/Form/AppForm';

Vue.component('user-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                email:  '' ,
                password:  '' ,
                first_name:  '' ,
                last_name:  '' ,
                activated:  false ,
                forbidden:  false ,
                language:  '' ,
                
            }
        }
    }
});