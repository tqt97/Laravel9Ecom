<script setup>
import {ref} from "vue";
import Editor from "@tinymce/tinymce-vue";

import Input from "@/admin/Components/Input.vue";
import Label from "@/admin/Components/Label.vue";
import InputError from "@/admin/Components/InputError.vue";
defineProps({
    modelValue: {},
    label: {
        type: String,
        default: "",
    },
    errorMessage: {
        type: String,
        default: "",
    },
});

const config = ref({
    height: 500,
    // selector: 'textarea#file-picker',

    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste"
    ],
    toolbar1: "undo redo | styleselect | fontselect | fontsizeselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink image",
    // font_family_formats: 'Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; AkrutiKndPadmini=Akpdmi-n',
    // font_formats: "Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Oswald=oswald; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
    // content_style: "@import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap'); body { font-family: Oswald; }",
    image_title: true,
    automatic_uploads: true,

    image_advtab: true,
    file_picker_types: 'image',
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                var id = 'blobid' + (new Date()).getTime();
                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), {title: file.name});
            };
            reader.readAsDataURL(file);
        };
        input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:12px }'
});

</script>

<template>
    <div>
        <Label v-if=" label " :value=" label " />
        <editor api-key="hu39m4mn8mj0uy7bx6ubsxdf2nuq6k3peda90m28kn6xotn6"
            :model-value=" modelValue "
            @update:model-value=" $emit( 'update:modelValue', $event ) "
            :init=" config " v-bind=" $attrs " />
        <InputError v-if=" errorMessage " class=" mt-1"
            :message=" errorMessage " />
    </div>
</template>
