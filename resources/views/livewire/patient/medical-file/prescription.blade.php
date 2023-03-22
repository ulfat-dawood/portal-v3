<div class="flex flex-col gap-0.5 min-w-[450px]">

    <!-- ROW TITLE -->
    <div class="bg-white rounded-lg flex gap-5 px-5 py-1.5">

        <!-- name -->
        <div class="w-4/12 felx-shrink-0 flex-grow-0 text-main-600 text-xs font-medium">
            Medication
        </div>

        <!-- dosage  -->
        <div class="w-2/12 felx-shrink-0 flex-grow-0 text-main-600 text-xs font-medium">
            Dosage
        </div>

        <!-- instructions  -->
        <div class="w-6/12 felx-shrink-0 flex-grow-0 text-main-600 text-xs font-medium">
            Instructions
        </div>
    </div>

    @forelse ( $child as $item)
        <div wire:key='item-{{$item['phOrderId']}}'
        class="bg-white rounded-lg flex gap-5 px-5 py-1.5">

            <!-- name -->
            <div class="w-4/12 min-w-0 felx-shrink-0 flex-grow-0  text-xs font-normal break-words">
                {{$item['srvcName']}}
            </div>

            <!-- dosage  -->
            <div class="w-2/12 min-w-0 felx-shrink-0 flex-grow-0  text-xs font-normal break-words">
                {{$item['packageSize']}}
            </div>

            <!-- instructions  -->
            <div class="w-6/12 min-w-0 felx-shrink-0 flex-grow-0  text-xs font-normal break-words">
                {{$item['mahAgentName']}}
            </div>
        </div>
    @empty
        non found
    @endforelse
    <!-- ROW  -->





</div>
