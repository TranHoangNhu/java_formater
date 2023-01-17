<!doctype html>
<html lang="en">

<head>
    <title>Editor_java</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,400;0,600;0,700;1,200;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/prism.css">
</head>
</head>

<body>
    <div class="container mt-5">
        <select class="form-select" id="myselect">
            <option selected>Open this select menu</option>
            <!-- <option value="1">One</option> -->
            <?php
            foreach (new DirectoryIterator('./uploads') as $fileInfo) {
                if ($fileInfo->isDot()) continue;
                $item = $fileInfo->getFilename();
                echo '<option value="' . $item . '">' . $item . '</option>';
            } ?>
        </select>

        <textarea id="file-content" style="width: 100%; min-height:800px;" class="d-none"></textarea>
        <pre>
            <code class="language-java fw-bold">
            </code>
        </pre>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/java-class-tools@latest/dist/java-class-tools.min.js"></script>

    <script>
        document.getElementById("myselect").addEventListener("change", function() {
            console.log('123');
            var fileName = document.querySelector(".form-select").value;
            fetch(`./uploads/${fileName}`)
                .then(r => r.arrayBuffer())
                .then(printAllMethods);

            function printAllMethods(classData) {
                document.querySelector("#file-content").innerHTML = "";
                const reader = new JavaClassTools.JavaClassFileReader();
                const classFile = reader.read(classData);
                const textDecoder = new TextDecoder();

                classFile.methods.forEach(method => {
                    /**
                     * Method name in constant-pool.
                     * 
                     * Points to a CONSTANT_Utf8_info structure: https://docs.oracle.com/javase/specs/jvms/se8/html/jvms-4.html#jvms-4.4.7
                     */
                    const nameEntry = classFile.constant_pool[method.name_index];

                    const name = textDecoder.decode(new Uint8Array(nameEntry.bytes));

                    console.log(typeof(name));
                    document.querySelector('#file-content').innerHTML += `${name}\n`;
                    document.querySelector("code").textContent = document.querySelector('#file-content').value;
                });
            }
        });
    </script>
    <script src="./js/prism.js"></script>
</body>

</html>