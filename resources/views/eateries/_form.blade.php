@if ($errors->any())
    <div class="mb-6 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-800">
        <p class="font-semibold">Please fix the following:</p>
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $selectedFeatures = old('features', $eatery->exists ? $eatery->features->pluck('id')->all() : []);
@endphp

<div class="grid grid-cols-1 gap-4">
    <div>
        <label for="name" class="block font-medium">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $eatery->name) }}"
               class="w-full border rounded px-3 py-2">
        @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="district_id" class="block font-medium">District</label>
        <select id="district_id" name="district_id" class="w-full border rounded px-3 py-2">
            <option value="">Choose a district</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(old('district_id', $eatery->district_id) == $district->id)>{{ $district->name }}</option>
            @endforeach
        </select>
        @error('district_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="address" class="block font-medium">Address</label>
        <input type="text" id="address" name="address" value="{{ old('address', $eatery->address) }}"
               class="w-full border rounded px-3 py-2">
        @error('address') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="price_range" class="block font-medium">Price range</label>
        <select id="price_range" name="price_range" class="w-full border rounded px-3 py-2">
            <option value="">Choose a price range</option>
            @foreach (['budget' => 'Budget (₱)', 'mid' => 'Mid (₱₱)', 'splurge' => 'Splurge (₱₱₱)'] as $value => $label)
                <option value="{{ $value }}" @selected(old('price_range', $eatery->price_range) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('price_range') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="specialty" class="block font-medium">Specialty</label>
        <input type="text" id="specialty" name="specialty" value="{{ old('specialty', $eatery->specialty) }}"
               class="w-full border rounded px-3 py-2">
        @error('specialty') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="inline-flex items-center gap-2">
            <input type="checkbox" name="is_open" value="1" @checked(old('is_open', $eatery->is_open ?? true))>
            <span class="font-medium">Open</span>
        </label>
        @error('is_open') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <p class="font-medium">Features</p>
        <div class="flex flex-wrap gap-4">
            @foreach ($features as $feature)
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                           @checked(in_array($feature->id, $selectedFeatures))>
                    <span>{{ $feature->name }}</span>
                </label>
            @endforeach
        </div>
        @error('features') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="permit_no" class="block font-medium">Permit number</label>
        <input type="text" id="permit_no" name="permit_no"
               value="{{ old('permit_no', $eatery->permit?->permit_no) }}"
               class="w-full border rounded px-3 py-2">
        @error('permit_no') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="expires_on" class="block font-medium">Permit expiry date</label>
        <input type="date" id="expires_on" name="expires_on"
               value="{{ old('expires_on', $eatery->permit?->expires_on?->format('Y-m-d')) }}"
               class="w-full border rounded px-3 py-2">
        @error('expires_on') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>