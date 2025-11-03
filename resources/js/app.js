import './bootstrap';
import Alpine from "alpinejs";
import persist from "@alpinejs/persist";
import collapse from '@alpinejs/collapse'

Alpine.plugin(collapse)
Alpine.plugin(persist);

window.Alpine = Alpine;
Alpine.start();


document.addEventListener('alpine:init', () => {
    Alpine.store('dateStore', {
        // Store for multiple date pickers
        selectedDate: {
            value: '',
            display: '',
            dateObject: null
        },
        appointmentDate: {
            value: '',
            display: '',
            dateObject: null
        },
        checkoutDate: {
            value: '',
            display: '',
            dateObject: null
        }
    });
});
