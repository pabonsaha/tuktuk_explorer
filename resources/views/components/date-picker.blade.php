<!-- resources/views/components/date-picker.blade.php -->
<div x-data="datePicker()" class="space-y-1">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label ?? 'Select Date' }}
    </label>

    <div class="relative" @click.away="showCalendar = false">
        <!-- Date Input Display -->
        <button
            type="button"
            @click="showCalendar = !showCalendar"
            class="w-full bg-white border border-gray-300 rounded-xl py-3 pl-4 pr-10 shadow-sm hover:border-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-left">
            <span x-text="$store.dateStore.{{ $name ?? 'selectedDate' }}.display || 'Choose a date'"
                  :class="$store.dateStore.{{ $name ?? 'selectedDate' }}.display ? 'text-gray-900' : 'text-gray-400'"></span>
        </button>

        <!-- Calendar Icon -->
        <span class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </span>

        <!-- Calendar Dropdown -->
        <div x-show="showCalendar"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute z-50 mt-2 w-80 bg-white rounded-2xl shadow-xl border border-gray-200 p-4"
             @click.stop>

            <!-- Month Navigation -->
            <div class="flex items-center justify-between mb-4">
                <button
                    type="button"
                    @click="prevMonth()"
                    :disabled="!canGoBack()"
                    :class="canGoBack() ? 'hover:bg-gray-100 text-gray-700' : 'text-gray-300 cursor-not-allowed'"
                    class="p-2 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <h3 class="text-base font-semibold text-gray-900" x-text="monthName"></h3>

                <button
                    type="button"
                    @click="nextMonth()"
                    class="p-2 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Weekday Headers -->
            <div class="grid grid-cols-7 gap-1 mb-2">
                <template x-for="day in ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa']">
                    <div class="text-center text-xs font-medium text-gray-500 py-2" x-text="day"></div>
                </template>
            </div>

            <!-- Calendar Days -->
            <div class="grid grid-cols-7 gap-1">
                <template x-for="day in calendarDays" :key="day">
                    <button
                        type="button"
                        @click="selectDate(day)"
                        :disabled="isDateDisabled(day)"
                        :class="{
                            'invisible': !day,
                            'bg-blue-500 text-white font-semibold hover:bg-blue-600': isDateSelected(day),
                            'ring-2 ring-blue-500 ring-offset-1': isToday(day) && !isDateSelected(day),
                            'text-gray-300 cursor-not-allowed': isDateDisabled(day) && day,
                            'hover:bg-gray-100 text-gray-700': !isDateDisabled(day) && !isDateSelected(day) && day
                        }"
                        class="aspect-square flex items-center justify-center rounded-lg text-sm transition-all"
                        x-text="day">
                    </button>
                </template>
            </div>

            <!-- Footer -->
            <div class="mt-4 pt-3 border-t border-gray-200 flex justify-between items-center">
                <button
                    type="button"
                    @click="selectDate(today.getDate()); currentMonth = today.getMonth(); currentYear = today.getFullYear();"
                    class="text-sm text-blue-600 hover:text-blue-700 font-medium transition">
                    Today
                </button>
                <button
                    type="button"
                    @click="showCalendar = false"
                    class="text-sm text-gray-600 hover:text-gray-700 font-medium transition">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden input for form submission -->
    <input type="hidden"
           name="{{ $name ?? 'selected_date' }}"
           x-model="$store.dateStore.{{ $name ?? 'selectedDate' }}.value">
</div>

<script>
    function datePicker() {
        return {
            showCalendar: false,
            currentMonth: new Date().getMonth(),
            currentYear: new Date().getFullYear(),
            today: new Date(),
            fieldName: '{{ $name ?? "selectedDate" }}',

            init() {
                this.today.setHours(0, 0, 0, 0);

                // Initialize store if not exists
                if (!this.$store.dateStore[this.fieldName]) {
                    this.$store.dateStore[this.fieldName] = {
                        value: '',
                        display: '',
                        dateObject: null
                    };
                }
            },

            get monthName() {
                const date = new Date(this.currentYear, this.currentMonth);
                return date.toLocaleDateString('en-US', {month: 'long', year: 'numeric'});
            },

            get daysInMonth() {
                return new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
            },

            get firstDayOfMonth() {
                return new Date(this.currentYear, this.currentMonth, 1).getDay();
            },

            get calendarDays() {
                const days = [];
                const daysInMonth = this.daysInMonth;
                const firstDay = this.firstDayOfMonth;

                for (let i = 0; i < firstDay; i++) {
                    days.push(null);
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    days.push(day);
                }

                return days;
            },

            isDateDisabled(day) {
                if (!day) return true;
                const date = new Date(this.currentYear, this.currentMonth, day);
                date.setHours(0, 0, 0, 0);
                return date < this.today;
            },

            isDateSelected(day) {
                if (!day || !this.$store.dateStore[this.fieldName].dateObject) return false;
                const date = new Date(this.currentYear, this.currentMonth, day);
                return date.toDateString() === this.$store.dateStore[this.fieldName].dateObject.toDateString();
            },

            isToday(day) {
                if (!day) return false;
                const date = new Date(this.currentYear, this.currentMonth, day);
                return date.toDateString() === this.today.toDateString();
            },

            selectDate(day) {
                if (!day || this.isDateDisabled(day)) return;

                const selectedDate = new Date(this.currentYear, this.currentMonth, day);

                // Update global store
                this.$store.dateStore[this.fieldName] = {
                    value: selectedDate.toISOString().split('T')[0], // YYYY-MM-DD format
                    display: selectedDate.toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    }),
                    dateObject: selectedDate
                };

                this.showCalendar = false;
            },

            canGoBack() {
                const currentDate = new Date(this.currentYear, this.currentMonth, 1);
                const todayMonth = new Date(this.today.getFullYear(), this.today.getMonth(), 1);
                return currentDate > todayMonth;
            },

            prevMonth() {
                if (!this.canGoBack()) return;

                if (this.currentMonth === 0) {
                    this.currentMonth = 11;
                    this.currentYear--;
                } else {
                    this.currentMonth--;
                }
            },

            nextMonth() {
                if (this.currentMonth === 11) {
                    this.currentMonth = 0;
                    this.currentYear++;
                } else {
                    this.currentMonth++;
                }
            }
        }
    }
</script>
