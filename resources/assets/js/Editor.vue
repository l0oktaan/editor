<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <app-editor-filter></app-editor-filter>
                <app-editor-show></app-editor-show>
            </div>
        </div>
        
    </div>
</template>
<script>    
    import axios from 'axios';
    import EditorFilter from './components/EditorFilter.vue';
    import EditorShow from './components/EditorShow.vue';
    export default {
        components: {
            appEditorFilter: EditorFilter,
            appEditorShow: EditorShow
        }
    }
</script>