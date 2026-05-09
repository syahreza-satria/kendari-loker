<x-layout.profile>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

        <style>
            .ql-toolbar.ql-snow {
                border: none !important;
                border-bottom: 1px solid #e5e7eb !important;
                background-color: #f9fafb;
            }

            .ql-container.ql-snow {
                border: none !important;
                font-family: inherit !important;
            }

            .ql-editor {
                min-height: 12rem;
            }
        </style>
    @endpush

    <section class="p-6 bg-white shadow rounded-box">
        <h2 class="text-2xl font-medium">Tambah Lowongan Pekerjaan</h2>
    </section>

    <section class="p-6 bg-white shadow rounded-box flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-medium">Informasi Loker</h1>
        </div>

        <form action="{{ route('employer.jobs.store') }}" method="POST" enctype="multipart/form-data" id="job-form">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                {{-- Judul --}}
                <label class="flex flex-col form-control w-full space-y-1 md:col-span-2">
                    <span class="text-sm font-semibold">
                        Judul / Posisi Pekerjaan<span class="text-error">*</span>
                    </span>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="input input-bordered w-full rounded-selector @error('title') input-error @enderror"
                        placeholder="Contoh: Frontend Developer">
                    @error('title')
                        <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                </label>

                {{-- Kategori --}}
                <label class="flex flex-col form-control w-full space-y-1">
                    <span class="text-sm font-semibold">
                        Kategori<span class="text-error">*</span>
                    </span>
                    <select name="category_id"
                        class="select select-bordered w-full rounded-selector @error('category_id') select-error @enderror">
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Pilih Kategori
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                </label>

                {{-- Tipe --}}
                <label class="flex flex-col form-control w-full space-y-1">
                    <span class="text-sm font-semibold">
                        Tipe<span class="text-error">*</span>
                    </span>
                    <select name="type_id"
                        class="select select-bordered w-full rounded-selector @error('type_id') select-error @enderror">
                        <option value="" disabled {{ old('type_id') ? '' : 'selected' }}>Pilih Tipe</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                {{ ucfirst($type->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('type_id')
                        <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                </label>

                {{-- Lokasi --}}
                <label class="flex flex-col form-control w-full space-y-1 md:col-span-2">
                    <span class="text-sm font-semibold">
                        Lokasi Penempatan<span class="text-error">*</span>
                    </span>
                    <input type="text" name="location_area" value="{{ old('location_area') }}"
                        class="input input-bordered w-full rounded-selector @error('location_area') input-error @enderror"
                        placeholder="Contoh: Mandonga, Kota Kendari">
                    @error('location_area')
                        <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                </label>

                {{-- Gaji Min --}}
                <div class="flex flex-col form-control w-full space-y-1">
                    <span class="text-sm font-semibold">
                        Gaji Minimal <span class="text-neutral-500">(Opsional)</span>
                    </span>
                    <label
                        class="input input-bordered rounded-selector w-full flex items-center gap-2 @error('salary_min') input-error @enderror">
                        <span class="font-semibold text-gray-500">Rp</span>
                        <input type="number" name="salary_min" placeholder="3500000" min="0"
                            value="{{ old('salary_min') }}" class="grow" />
                    </label>
                    @error('salary_min')
                        <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Gaji Max --}}
                <div class="flex flex-col form-control w-full space-y-1">
                    <span class="text-sm font-semibold">
                        Gaji Maksimal <span class="text-neutral-500">(Opsional)</span>
                    </span>
                    <label
                        class="input input-bordered rounded-selector w-full flex items-center gap-2 @error('salary_max') input-error @enderror">
                        <span class="font-semibold text-gray-500">Rp</span>
                        <input type="number" name="salary_max" placeholder="5000000" min="0"
                            value="{{ old('salary_max') }}" class="grow" />
                    </label>
                    @error('salary_max')
                        <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tanggal Penutupan (Closing Date) - BARU --}}
                <label class="flex flex-col form-control w-full space-y-1">
                    <span class="text-sm font-semibold">
                        Batas Akhir Lamaran<span class="text-error">*</span>
                    </span>
                    <input type="date" name="closing_date" value="{{ old('closing_date') }}"
                        class="input input-bordered w-full rounded-selector @error('closing_date') input-error @enderror">
                    @error('closing_date')
                        <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                </label>

                {{-- Tautan Eksternal (Link) - BARU --}}
                <label class="flex flex-col form-control w-full space-y-1">
                    <span class="text-sm font-semibold">
                        Tautan Pendaftaran Pihak Ketiga <span class="text-neutral-500">(Opsional)</span>
                    </span>
                    <input type="url" name="link" value="{{ old('link') }}"
                        class="input input-bordered w-full rounded-selector @error('link') input-error @enderror"
                        placeholder="https://gforms.com/...">
                    @error('link')
                        <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                </label>

                {{-- Poster Upload - BARU --}}
                <label class="flex flex-col form-control w-full space-y-1 md:col-span-2">
                    <span class="text-sm font-semibold">
                        Poster Lowongan <span class="text-neutral-500">(Opsional, Maks 2MB)</span>
                    </span>
                    <input type="file" name="poster" accept="image/*"
                        class="file-input file-input-bordered w-full rounded-selector @error('poster') file-input-error @enderror" />
                    @error('poster')
                        <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                </label>

                {{-- Deskripsi --}}
                <label class="flex flex-col form-control w-full space-y-1 md:col-span-2 mt-2">
                    <span class="text-sm font-semibold">
                        Deskripsi<span class="text-error">*</span>
                    </span>
                    <div
                        class="w-full bg-white text-black border rounded-selector overflow-hidden @error('description') border-error @else border-gray-300 dark:border-gray-600 @enderror">
                        <div id="editor-description">{!! old('description') !!}</div>
                    </div>
                    <input type="hidden" name="description" id="description">
                    @error('description')
                        <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                </label>

                {{-- Kualifikasi --}}
                <label class="flex flex-col form-control w-full space-y-1 md:col-span-2 mt-2">
                    <span class="text-sm font-semibold">
                        Kualifikasi/Persyaratan<span class="text-error">*</span>
                    </span>
                    <div
                        class="w-full bg-white text-black border rounded-selector overflow-hidden @error('requirements') border-error @else border-gray-300 dark:border-gray-600 @enderror">
                        <div id="editor-requirements">{!! old('requirements') !!}</div>
                    </div>
                    <input type="hidden" name="requirements" id="requirements">
                    @error('requirements')
                        <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                </label>

                {{-- Toggle Aktif / Draft - BARU --}}
                <div class="flex flex-col form-control w-full md:col-span-2 mt-2">
                    <label class="cursor-pointer label justify-start gap-4 p-0">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="toggle toggle-primary"
                            {{ old('is_active', true) ? 'checked' : '' }} />
                        <span class="label-text font-semibold">Tayangkan Lowongan Segera (Aktif)</span>
                    </label>
                </div>

            </div>

            <div class="flex gap-2 justify-end mt-6 border-t pt-4">
                <a href="{{ route('employer.jobs.index') }}" class="btn rounded-selector">Kembali</a>
                <button type="submit" class="btn btn-primary rounded-selector">Tambah Data</button>
            </div>
        </form>
    </section>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const toolbarOptions = [
                    ['bold', 'italic', 'underline'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    ['clean']
                ];

                const quillDesc = new Quill('#editor-description', {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    theme: 'snow',
                    placeholder: 'Tuliskan deskripsi pekerjaan di sini...'
                });

                const quillReq = new Quill('#editor-requirements', {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    theme: 'snow',
                    placeholder: 'Tuliskan kualifikasi atau persyaratan di sini...'
                });

                const form = document.getElementById('job-form');
                form.addEventListener('submit', function() {
                    const descriptionInput = document.getElementById('description');
                    const requirementsInput = document.getElementById('requirements');

                    descriptionInput.value = quillDesc.root.innerHTML;
                    requirementsInput.value = quillReq.root.innerHTML;

                    if (quillDesc.root.innerText.trim() === '') descriptionInput.value = '';
                    if (quillReq.root.innerText.trim() === '') requirementsInput.value = '';
                });
            });
        </script>
    @endpush
</x-layout.profile>
