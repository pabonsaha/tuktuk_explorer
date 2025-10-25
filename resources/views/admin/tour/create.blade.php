@extends('admin.layout.master')

@section('content')
    <div
        x-data="tourForm()"
        x-init="initQuill();"
        class=" mx-auto p-6 shadow space-y-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
    >
        <h2 class="text-base font-medium text-gray-800 dark:text-white/90">Create New Tour</h2>

        <form x-ref="tourForm" @submit.prevent="submitForm" class="space-y-6" enctype="multipart/form-data">
            @csrf
            {{-- General server error --}}
            <template x-if="errors.general">
                <p class="text-sm text-red-500 bg-red-100 p-2 rounded" x-text="errors.general"></p>
            </template>

            {{-- Title --}}
            <div class="mt-4">
                <label class="text-base font-medium text-gray-800 dark:text-white/90">Title</label>
                <input type="text" name="title" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" placeholder="Enter tour title" :class="{'!border-red-500': errors.title}">
                <template x-if="errors.title">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.title[0]"></p>
                </template>
            </div>

            {{-- Description --}}
            <div  class="mt-4">
                <label class="text-base font-medium text-gray-800 dark:text-white/90">Description</label>
                <div id="quillEditor" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-64 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="{'!border-red-500': errors.description}"></div>
                <input type="hidden" name="description" x-ref="description">
                <template x-if="errors.description">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.description[0]"></p>
                </template>
            </div>

            {{-- Thumbnail --}}
            <div  class="mt-4">
                <label class="text-base font-medium text-gray-800 dark:text-white/90">Thumbnail</label>
                {{-- Changed name attribute to x-ref to prevent FormData auto-collection --}}
                <input type="file" x-ref="thumbnailFile" name="thumbnail" accept="image/*" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                       @change="previewThumb($event)" :class="{'!border-red-500': errors.thumbnail}">
                <template x-if="errors.thumbnail">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.thumbnail[0]"></p>
                </template>
                <template x-if="thumbnail">
                    <img :src="thumbnail" class="mt-3 rounded-lg w-40 h-28 object-cover">
                </template>
            </div>

            {{-- Tour Duration --}}
            <div class="mt-4">
                <label class="text-base font-medium text-gray-800 dark:text-white/90">Tour Duration</label>
                <input type="text" name="tour_duration" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                       placeholder="e.g. 3 Days, 2 Nights" :class="{'!border-red-500': errors.tour_duration}">
                <template x-if="errors.tour_duration">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.tour_duration[0]"></p>
                </template>
            </div>

            {{-- Starting Price --}}
            <div  class="mt-4">
                <label class="text-base font-medium text-gray-800 dark:text-white/90">Starting Price</label>
                <input type="number" step="0.01" name="starting_price" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="{'!border-red-500': errors.starting_price}">
                <template x-if="errors.starting_price">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.starting_price[0]"></p>
                </template>
            </div>

            {{-- Number of People --}}
            <div  class="mt-4">
                <label class="text-base font-medium text-gray-800 dark:text-white/90">Number of People</label>
                <input type="number" name="num_of_people" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="{'!border-red-500': errors.num_of_people}">
                <template x-if="errors.num_of_people">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.num_of_people[0]"></p>
                </template>
            </div>

            {{-- JSON Fields --}}
            <template x-for="field in jsonFields" :key="field.name">
                <div class="border-t pt-4 mt-4">
                    <label class="text-base font-medium text-gray-800 dark:text-white/90" x-text="field.label"></label>

                    <template x-for="(item, index) in field.items" :key="index">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <input type="text" :name="`${field.name}[]`" x-model="field.items[index]"
                                       class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" placeholder="Enter value"
                                       :class="{'!border-red-500': errors[`${field.name}.${index}`]}">
                                <button type="button" class="bg-red-600 text-white px-2 py-1 rounded"
                                        @click="removeJsonRow(field.name, index)">X</button>
                            </div>
                            {{-- Correctly bound to field_name.INDEX --}}
                            <template x-if="errors[`${field.name}.${index}`]">
                                <p class="text-sm text-red-500 mt-1 mb-2" x-text="errors[`${field.name}.${index}`][0]"></p>
                            </template>
                        </div>
                    </template>

                    <button type="button" class="bg-blue-600 text-white px-3 py-1 rounded mt-2"
                            @click="addJsonRow(field.name)">+ Add</button>
                </div>
            </template>

            {{-- Meeting Point --}}
            <div class="border-t pt-4 mt-4">
                <label class="text-base font-medium text-gray-800 dark:text-white/90">Meeting Point</label>
                <template x-for="(item, index) in meeting_point" :key="index">
                    <div class="mb-4 p-3 border border-gray-100 rounded-lg">
                        <div class="flex items-center gap-2 mb-2">
                            <input type="text" :name="`meeting_point[${index}][name]`"
                                   x-model="meeting_point[index].name"
                                   class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" placeholder="Enter name">
                            <button type="button" class="bg-red-600 text-white px-2 py-1 rounded h-11 flex-shrink-0"
                                    @click="removeMeetingPointRow(index)">X</button>
                        </div>
                        {{-- FIX: Correctly bound to meeting_point.INDEX.name --}}
                        <template x-if="errors[`meeting_point.${index}.name`]">
                            <p class="text-sm text-red-500 mt-1" x-text="errors[`meeting_point.${index}.name`][0]"></p>
                        </template>

                        <div class="mt-2">
                            <input type="text" :name="`meeting_point[${index}][link]`"
                                   x-model="meeting_point[index].link"
                                   class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" placeholder="Enter link (optional)">
                        </div>
                        {{-- FIX: Correctly bound to meeting_point.INDEX.link --}}
                        <template x-if="errors[`meeting_point.${index}.link`]">
                            <p class="text-sm text-red-500 mt-1" x-text="errors[`meeting_point.${index}.link`][0]"></p>
                        </template>

                    </div>
                </template>
                <button type="button" class="bg-blue-600 text-white px-3 py-1 rounded mt-2"
                        @click="addMeetingPointRow()">+ Add Meeting Point</button>
            </div>

            {{-- Dynamic Tour Images (FIXED VALIDATION HERE) --}}
            <div class="border-t pt-4 mt-4">
                <label class="text-base font-medium text-gray-800 dark:text-white/90">Tour Images</label>

                <template x-for="(image, index) in images" :key="index">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <input type="file" :name="`images[]`" accept="image/*"
                                   class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                   @change="previewImage($event, index)"
                                   :class="{'!border-red-500': errors[`images.${index}`]}">
                            <template x-if="image.preview">
                                <img :src="image.preview" class="w-28 h-20 object-cover rounded">
                            </template>
                            <button type="button" class="bg-red-600 text-white px-2 py-1 rounded"
                                    @click="removeImage(index)">X</button>
                        </div>
                        {{-- Correctly bound to images.INDEX for file validation --}}
                        <template x-if="errors[`images.${index}`]">
                            <p class="text-sm text-red-500 mt-1 mb-2" x-text="errors[`images.${index}`][0]"></p>
                        </template>
                    </div>
                </template>

                {{-- General array errors (e.g., minimum required count) --}}
                <template x-if="errors.images">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.images[0]"></p>
                </template>

                <button type="button" class="bg-blue-600 text-white px-3 py-1 rounded mt-2" @click="addImage">+ Add Image</button>
            </div>

            {{-- Note --}}
            <div  class="mt-4">
                <label class="text-base font-medium text-gray-800 dark:text-white/90">Note</label>
                <textarea name="note" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-28 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" rows="3" :class="{'!border-red-500': errors.note}"></textarea>
                <template x-if="errors.note">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.note[0]"></p>
                </template>
            </div>

            {{-- Submit --}}
            <div class="text-right">
                <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded" :disabled="isSubmitting" x-text="isSubmitting ? 'Saving...' : 'Save Tour'"></button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script>
        function tourForm() {
            return {
                quill: null,
                thumbnail: null,
                isSubmitting: false,
                errors: {}, // Object to hold validation errors
                // Define the redirect URL after successful submission
                redirectUrl: '{{ route('admin.tours.index') }}', // Change this to your desired redirect route

                jsonFields: [
                    { name: 'specifications', label: 'Specifications', items: [] },
                    { name: 'requirements', label: 'Requirements', items: [] },
                    { name: 'tour_highlights', label: 'Tour Highlights', items: [] },
                ],
                meeting_point: [],
                images: [],

                initQuill() {
                    const toolbarOptions = [
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'color': [] }, { 'background': [] }],
                        ['clean']
                    ];
                    this.quill = new Quill('#quillEditor', {
                        theme: 'snow',
                        modules: {
                            toolbar: toolbarOptions
                        }
                    });
                },

                // Resets the errors object
                clearErrors() {
                    this.errors = {};
                },

                // Handles form submission via AJAX
                async submitForm() {
                    // 1. Clear previous errors and set submission state
                    this.clearErrors();
                    this.isSubmitting = true;

                    // 2. Populate hidden description field
                    this.$refs.description.value = this.quill.root.innerHTML;

                    // 3. Prepare form data for AJAX submission
                    const form = this.$refs.tourForm;
                    const formData = new FormData(form);

                    // --- START ROBUST FILE HANDLING ---
                    // 3a. Delete files appended automatically by FormData(form) to prevent conflicts.
                    // This is essential for dynamic file inputs and inputs where we changed 'name' to 'x-ref'.
                    formData.delete('thumbnail');
                    formData.delete('images[]');

                    // 3b. Manually append the thumbnail file (now referenced via x-ref)
                    const thumbnailInput = this.$refs.thumbnailFile;
                    if (thumbnailInput.files.length > 0) {
                        formData.append('thumbnail', thumbnailInput.files[0]);
                    }

                    // 3c. Manually append only the selected dynamic image files.
                    const fileInputs = form.querySelectorAll('input[type="file"][name="images[]"]');

                    fileInputs.forEach((input) => {
                        if (input.files.length > 0) {
                            // Append the file using the correct array notation
                            formData.append('images[]', input.files[0]);
                        }
                    });
                    // --- END ROBUST FILE HANDLING ---

                    // 4. Send AJAX request
                    try {
                        const response = await fetch(
                            '{{ route('admin.tours.store') }}', // Your form action route
                            {
                                method: 'POST',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                },
                                body: formData,
                            }
                        );

                        if (response.ok) {
                            // Submission successful
                            const data = await response.json();
                            toastr.success(data.message);

                            window.location.href = this.redirectUrl;
                        } else if (response.status === 422) {
                            // Validation errors
                            const errorData = await response.json();
                            this.errors = errorData.errors;
                            // Optionally, scroll to the first error
                            const firstError = document.querySelector('.text-red-500');
                            if (firstError) {
                                firstError.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            }
                        } else {
                            // Other server errors (500, etc.)
                            this.errors.general = 'An unexpected error occurred. Please try again.';
                            console.error('Submission Error:', response.statusText);
                        }

                    } catch (error) {
                        // Network error
                        this.errors.general = 'Network error: Could not connect to the server.';
                        console.error('Network Error:', error);
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                // Thumbnail preview
                previewThumb(event) {
                    this.clearErrors();
                    const file = event.target.files[0];
                    if (file) this.thumbnail = URL.createObjectURL(file);
                },

                // JSON field controls
                addJsonRow(fieldName) {
                    this.clearErrors();
                    const field = this.jsonFields.find(f => f.name === fieldName);
                    field.items.push('');
                },
                removeJsonRow(fieldName, index) {
                    this.clearErrors();
                    const field = this.jsonFields.find(f => f.name === fieldName);
                    field.items.splice(index, 1);
                },

                // Meeting Point
                addMeetingPointRow() {
                    this.clearErrors();
                    this.meeting_point.push({ name: '', link: '' });
                },
                removeMeetingPointRow(index) {
                    this.clearErrors();
                    this.meeting_point.splice(index, 1);
                },

                // Image controls
                addImage() {
                    this.clearErrors();
                    // When adding a new image row, push a simple object that will be used
                    // for the preview, the file reference itself comes from the input's files property.
                    this.images.push({ preview: null });
                },
                removeImage(index) {
                    this.clearErrors();
                    this.images.splice(index, 1);
                },
                previewImage(event, index) {
                    this.clearErrors();
                    const file = event.target.files[0];
                    if (file) {
                        this.images[index].preview = URL.createObjectURL(file);
                    }
                }
            };
        }
    </script>
@endpush
