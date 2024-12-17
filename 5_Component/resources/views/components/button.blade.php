@props(['flag'])
<div>
    <button 
    {{$attributes->merge(['type'=>'submit'])class(['p-2 bg-gray-200', 'bg-red-400'=> !$flag, 'bg-green-400'=>$flag])}}>
    Submit
    </button>
</div>