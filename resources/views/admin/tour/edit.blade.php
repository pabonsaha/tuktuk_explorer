@extends('admin.layout.master')

@section('content')
    <div
        x-data="tourForm({ tour: {{ $tour->toJson() }} })"
        x-init="initQuill(); loadData( {{ $tour->toJson() }} );"
        class=" mx-auto p-6 shadow-2xl space-y-8 rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800/50"
    >
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white border-b pb-4">Edit Tour (<span
                x-text="title"></span>)</h2>

        <!-- Success Message Box -->
        <template x-if="isSuccess">
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200"
                 role="alert">
                <span class="font-medium">Success!</span> Tour updated. Reloading demo form in 3 seconds...
            </div>
        </template>

        <form x-ref="tourForm" @submit.prevent="submitForm" class="space-y-6" enctype="multipart/form-data">
            @csrf
            <!-- Important: Override form method for PATCH/PUT -->
            <input type="hidden" name="_method" value="PATCH">

            <!-- General server error -->
            <template x-if="errors.general">
                <p class="text-sm text-red-700 bg-red-100 p-3 rounded-lg border border-red-200 dark:bg-red-900 dark:text-red-100"
                   x-text="errors.general"></p>
            </template>

            <!-- Title -->
            <div class="mt-4">
                <label for="title-input"
                       class="block text-base font-medium text-gray-800 dark:text-white/90 mb-1">Title</label>
                <input id="title-input" type="text" name="title" x-model="title"
                       class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                       placeholder="Enter tour title" :class="{'!border-red-500': errors.title}">
                <template x-if="errors.title">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.title[0]"></p>
                </template>
            </div>

            <!-- Description -->
            <div class="mt-4">
                <label class="block text-base font-medium text-gray-800 dark:text-white/90 mb-1">Description</label>
                <div class="custom-quill-wrapper" :class="{'!border-red-500 border-2 !rounded-lg': errors.description}">
                    <div id="quillEditor"
                         class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-64 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></div>
                </div>
                <input type="hidden" name="description" x-ref="description">
                <template x-if="errors.description">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.description[0]"></p>
                </template>
            </div>

            <!-- Thumbnail -->
            <div class="mt-4">
                <label class="block text-base font-medium text-gray-800 dark:text-white/90 mb-1">Thumbnail (Upload new
                    to replace)</label>
                <input type="file" x-ref="thumbnailFile" name="thumbnail" accept="image/*"
                       class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                       @change="previewThumb($event)" :class="{'!border-red-500': errors.thumbnail}">
                <template x-if="errors.thumbnail">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.thumbnail[0]"></p>
                </template>
                <template x-if="thumbnail">
                    <img :src="thumbnail" class="mt-3 rounded-lg w-40 h-28 object-cover shadow-md">
                </template>
            </div>

            <!-- Tour Duration -->
            <div class="mt-4">
                <label class="block text-base font-medium text-gray-800 dark:text-white/90 mb-1">Tour Duration</label>
                <input type="text" name="tour_duration" x-model="tour_duration"
                       class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                       placeholder="e.g. 3 Days, 2 Nights" :class="{'!border-red-500': errors.tour_duration}">
                <template x-if="errors.tour_duration">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.tour_duration[0]"></p>
                </template>
            </div>

            <!-- Starting Price -->
            <div class="mt-4">
                <label class="block text-base font-medium text-gray-800 dark:text-white/90 mb-1">Starting Price</label>
                <input type="number" step="0.01" name="starting_price" x-model="starting_price"
                       class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                       :class="{'!border-red-500': errors.starting_price}">
                <template x-if="errors.starting_price">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.starting_price[0]"></p>
                </template>
            </div>

            <!-- Number of People -->
            <div class="mt-4">
                <label class="block text-base font-medium text-gray-800 dark:text-white/90 mb-1">Number of
                    People</label>
                <input type="number" name="num_of_people" x-model="num_of_people"
                       class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                       :class="{'!border-red-500': errors.num_of_people}">
                <template x-if="errors.num_of_people">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.num_of_people[0]"></p>
                </template>
            </div>

            <!-- 1. Specifications -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                <label class="block text-base font-medium text-gray-800 dark:text-white/90 mb-3">Specifications</label>
                <template x-for="(item, index) in specifications" :key="index">
                    <div>
                        <div class="flex items-start gap-2 mb-2">
                            <input type="text" :name="`specifications[]`" x-model="specifications[index]"
                                   class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                   placeholder="Enter specification"
                                   :class="{'!border-red-500': errors[`specifications.${index}`]}">
                            <button type="button"
                                    class="bg-red-600 hover:bg-red-700 transition-colors text-white text-lg px-3 py-1 rounded-lg h-11 flex-shrink-0"
                                    @click="removeJsonRow('specifications', index)" title="Remove Row">
                                &times;
                            </button>
                        </div>
                        <template x-if="errors[`specifications.${index}`]">
                            <p class="text-sm text-red-500 mb-2" x-text="errors[`specifications.${index}`][0]"></p>
                        </template>
                    </div>
                </template>
                <button type="button"
                        class="bg-blue-600 hover:bg-blue-700 transition-colors text-white px-4 py-2 rounded-lg mt-2 font-medium"
                        @click="addJsonRow('specifications')">+ Add Specification
                </button>
            </div>

            <!-- 2. Requirements -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                <label class="block text-base font-medium text-gray-800 dark:text-white/90 mb-3">Requirements</label>
                <template x-for="(item, index) in requirements" :key="index">
                    <div>
                        <div class="flex items-start gap-2 mb-2">
                            <input type="text" :name="`requirements[]`" x-model="requirements[index]"
                                   class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                   placeholder="Enter requirement"
                                   :class="{'!border-red-500': errors[`requirements.${index}`]}">
                            <button type="button"
                                    class="bg-red-600 hover:bg-red-700 transition-colors text-white text-lg px-3 py-1 rounded-lg h-11 flex-shrink-0"
                                    @click="removeJsonRow('requirements', index)" title="Remove Row">
                                &times;
                            </button>
                        </div>
                        <template x-if="errors[`requirements.${index}`]">
                            <p class="text-sm text-red-500 mb-2" x-text="errors[`requirements.${index}`][0]"></p>
                        </template>
                    </div>
                </template>
                <button type="button"
                        class="bg-blue-600 hover:bg-blue-700 transition-colors text-white px-4 py-2 rounded-lg mt-2 font-medium"
                        @click="addJsonRow('requirements')">+ Add Requirement
                </button>
            </div>

            <!-- 3. Tour Highlights -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                <label class="block text-base font-medium text-gray-800 dark:text-white/90 mb-3">Tour Highlights</label>
                <template x-for="(item, index) in tour_highlights" :key="index">
                    <div>
                        <div class="flex items-start gap-2 mb-2">
                            <input type="text" :name="`tour_highlights[]`" x-model="tour_highlights[index]"
                                   class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                   placeholder="Enter highlight"
                                   :class="{'!border-red-500': errors[`tour_highlights.${index}`]}">
                            <button type="button"
                                    class="bg-red-600 hover:bg-red-700 transition-colors text-white text-lg px-3 py-1 rounded-lg h-11 flex-shrink-0"
                                    @click="removeJsonRow('tour_highlights', index)" title="Remove Row">
                                &times;
                            </button>
                        </div>
                        <template x-if="errors[`tour_highlights.${index}`]">
                            <p class="text-sm text-red-500 mb-2" x-text="errors[`tour_highlights.${index}`][0]"></p>
                        </template>
                    </div>
                </template>
                <button type="button"
                        class="bg-blue-600 hover:bg-blue-700 transition-colors text-white px-4 py-2 rounded-lg mt-2 font-medium"
                        @click="addJsonRow('tour_highlights')">+ Add Highlight
                </button>
            </div>

            <!-- Meeting Point -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                <label class="block text-base font-medium text-gray-800 dark:text-white/90 mb-3">Meeting Point</label>
                <template x-for="(item, index) in meeting_point" :key="index">
                    <div
                        class="mb-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-900/50">
                        <div class="flex items-center gap-2 mb-2">
                            <input type="text" :name="`meeting_point[${index}][name]`"
                                   x-model="meeting_point[index].name"
                                   class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                   placeholder="Enter name (e.g., Central Station)"
                                   :class="{'!border-red-500': errors[`meeting_point.${index}.name`]}">
                            <button type="button"
                                    class="bg-red-600 hover:bg-red-700 transition-colors text-white text-lg px-3 py-1 rounded-lg h-11 flex-shrink-0"
                                    @click="removeMeetingPointRow(index)" title="Remove Meeting Point">
                                &times;
                            </button>
                        </div>
                        <template x-if="errors[`meeting_point.${index}.name`]">
                            <p class="text-sm text-red-500 mt-1" x-text="errors[`meeting_point.${index}.name`][0]"></p>
                        </template>

                        <div class="mt-3">
                            <input type="text" :name="`meeting_point[${index}][link]`"
                                   x-model="meeting_point[index].link"
                                   class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                   placeholder="Enter link (e.g., Google Maps URL) (optional)"
                                   :class="{'!border-red-500': errors[`meeting_point.${index}.link`]}">
                        </div>
                        <template x-if="errors[`meeting_point.${index}.link`]">
                            <p class="text-sm text-red-500 mt-1" x-text="errors[`meeting_point.${index}.link`][0]"></p>
                        </template>

                    </div>
                </template>
                <button type="button"
                        class="bg-blue-600 hover:bg-blue-700 transition-colors text-white px-4 py-2 rounded-lg mt-2 font-medium"
                        @click="addMeetingPointRow()">+ Add Meeting Point
                </button>
            </div>

            <!-- Tour Images Section -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                <label class="block text-base font-medium text-gray-800 dark:text-white/90 mb-3">Tour Images</label>

                <!-- Existing Images (with delete button) -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-4">
                    <template x-for="(img, index) in existingImages" :key="img.id">
                        <div class="relative group">
                            <img :src="img.preview" class="rounded-lg w-full h-32 object-cover shadow-md"/>
                            <button type="button"
                                    class="absolute top-1 right-1 bg-red-600 text-white px-2 py-1 rounded-md opacity-0 group-hover:opacity-100 transition"
                                    @click="removeExistingImage(index)">
                                &times;
                            </button>
                        </div>
                    </template>
                </div>

                <!-- Hidden deleted IDs -->
                <input type="hidden" name="deleted_images" x-model="deletedImageIds.join(',')">

                <div class="border-t pt-4 mt-4">
                    <label class="text-base font-medium text-gray-800 dark:text-white/90">Tour Images</label>

                    <template x-for="(image, index) in images" :key="index">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <input type="file" :name="`images[]`" accept="image/*"
                                       class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                       @change="previewNewImages($event, index)"
                                       :class="{'!border-red-500': errors[`images.${index}`]}">
                                <template x-if="image.preview">
                                    <img :src="image.preview" class="w-28 h-20 object-cover rounded">
                                </template>
                                <button type="button" class="bg-red-600 text-white px-2 py-1 rounded"
                                        @click="removeNewImage(index)">X
                                </button>
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

                    <button type="button" class="bg-blue-600 text-white px-3 py-1 rounded mt-2" @click="addImage">+ Add
                        Image
                    </button>
                </div>
            </div>

            <!-- Note -->
            <div class="mt-4">
                <label class="block text-base font-medium text-gray-800 dark:text-white/90 mb-1">Note</label>
                <textarea name="note" x-model="note"
                          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-28 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                          rows="3"
                          :class="{'!border-red-500': errors.note}"></textarea>
                <template x-if="errors.note">
                    <p class="text-sm text-red-500 mt-1" x-text="errors.note[0]"></p>
                </template>
            </div>

            <!-- Submit -->
            <div class="text-right border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 transition-colors text-white px-6 py-2.5 rounded-lg shadow-md font-semibold"
                        :disabled="isSubmitting" x-text="isSubmitting ? 'Updating...' : 'Update Tour'"></button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script>


        // --- END MOCK DATA ---

        function tourForm() {
            return {
                quill: null,
                tourId: null, // Store the ID of the tour being edited
                title: '',
                tour_duration: '',
                starting_price: null,
                num_of_people: null,
                note: '',
                thumbnail: null,
                isSubmitting: false,
                isSuccess: false,
                errors: {},

                // Separate JSON Fields (as requested)
                specifications: [],
                requirements: [],
                tour_highlights: [],

                meeting_point: [],
                existingImages: [], // loaded from backend


                images: [],
                deletedImageIds: [],
                newImagePreviews: [],


                initQuill() {
                    const toolbarOptions = [
                        ['bold', 'italic', 'underline', 'strike'],
                        [{'list': 'ordered'}, {'list': 'bullet'}],
                        [{'header': [1, 2, 3, 4, 5, 6, false]}],
                        [{'color': []}, {'background': []}],
                        ['clean']
                    ];
                    this.quill = new Quill('#quillEditor', {
                        theme: 'snow',
                        modules: {toolbar: toolbarOptions}
                    });
                },

                loadData(data) {
                    console.log(data);
                    this.tourId = data.id;
                    this.title = data.title;
                    this.tour_duration = data.tour_duration;
                    this.starting_price = data.starting_price;
                    this.num_of_people = data.num_of_people;
                    this.note = data.note;

                    // Load Quill content
                    this.$refs.description.value = data.description;
                    if (this.quill) {
                        this.quill.root.innerHTML = data.description;
                    }

                    this.thumbnail = `/storage/` + data.thumbnail;

                    // Load separated JSON fields
                    this.specifications = JSON.parse(data.specifications) || [];
                    this.requirements = JSON.parse(data.requirements) || [];
                    this.tour_highlights = JSON.parse(data.tour_highlights) || [];

                    // Load meeting points
                    this.meeting_point = JSON.parse(data.meeting_point) || [];

                    // Load existing images
                    this.existingImages = (data.images || []).map(img => ({
                        id: img.id,
                        preview: `/storage/` + img.image,
                        is_existing: true,
                        file: null
                    }));

                    console.log(this.existingImages);
                },

                clearErrors() {
                    this.errors = {};
                },

                // Mock Submission function
                async submitForm() {
                    this.clearErrors();
                    this.isSubmitting = true;
                    this.isSuccess = false;

                    // Update hidden description input from Quill
                    if (this.quill) {
                        this.$refs.description.value = this.quill.root.innerHTML;
                    }

                    const form = this.$refs.tourForm;
                    const formData = new FormData(form);

                    // ✅ Set PATCH method explicitly
                    formData.set('_method', 'PATCH');

                    // ✅ Handle thumbnail (replace if new file chosen)
                    const thumbnailInput = this.$refs.thumbnailFile;
                    if (thumbnailInput && thumbnailInput.files.length > 0) {
                        formData.set('thumbnail', thumbnailInput.files[0]);
                    } else {
                        formData.delete('thumbnail');
                    }


                    // ✅ Deleted images — send IDs as a comma-separated string
                    formData.set('deleted_images', this.deletedImageIds.join(','));

                    // ✅ Send request
                    const url = '{{ route('admin.tours.update', $tour->id) }}';

                    try {
                        const response = await fetch(url, {
                            method: 'POST', // PATCH over POST
                            headers: {'X-Requested-With': 'XMLHttpRequest'},
                            body: formData,
                        });

                        if (response.ok) {
                            this.isSuccess = true;
                            this.errors = {};

                            const data = await response.json();
                            toastr.success(data.message);


                            window.location.href = '{{ route('admin.tours.index') }}';

                        } else if (response.status === 422) {
                            const errorData = await response.json();
                            this.errors = errorData.errors;

                            // Scroll to first error
                            this.$nextTick(() => {
                                const firstError = document.querySelector('.text-red-500');
                                if (firstError) {
                                    firstError.scrollIntoView({behavior: 'smooth', block: 'start'});
                                }
                            });
                        } else {
                            const text = await response.text();
                            this.errors.general = `Server Error: ${response.status} - ${text.substring(0, 100)}...`;
                            console.error('Server Error:', response.status, response.statusText);
                        }
                    } catch (error) {
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

                // JSON field controls (handles all three separate fields now)
                addJsonRow(fieldName) {
                    this.clearErrors();
                    this[fieldName].push('');
                },
                removeJsonRow(fieldName, index) {
                    this.clearErrors();
                    this[fieldName].splice(index, 1);
                },

                // Meeting Point
                addMeetingPointRow() {
                    this.clearErrors();
                    this.meeting_point.push({name: '', link: ''});
                },
                removeMeetingPointRow(index) {
                    this.clearErrors();
                    this.meeting_point.splice(index, 1);
                },

                addImage() {
                    this.clearErrors();
                    // When adding a new image row, push a simple object that will be used
                    // for the preview, the file reference itself comes from the input's files property.
                    this.images.push({preview: null});
                },

                previewNewImages(event) {
                    this.newImagePreviews = [];
                    for (let file of event.target.files) {
                        this.newImagePreviews.push(URL.createObjectURL(file));
                    }
                },

                removeNewImage(index) {
                    this.images.slice(index,1);

                },

                removeExistingImage(index) {
                    const img = this.existingImages[index];
                    if (img && img.id) this.deletedImageIds.push(img.id);
                    this.existingImages.splice(index, 1);
                },
            };
        }
    </script>
@endpush
