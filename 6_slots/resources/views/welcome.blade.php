<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Slots</title>
</head>
<body class="grid place-content-center">
    <h1 class="mt-10 my-4">Home Page</h1>
    <x-card >
        <x-slot:title class="uppercase" type='submit'>
            I Phone 6
        </x-slot>

        <x-slot:subtitle>By Apple</x-slot>

        <x-slot:description>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur, deleniti.
        </x-slot>
    </x-card >
    
    <x-button>Save</x-button>
    <x-button>submit</x-button>
</body>
</html>