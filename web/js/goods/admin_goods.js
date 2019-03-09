Vue.component('FormImg', {
    'template': `
        <div class="img_item">
            <div>
                <div>
                    <div class="croppic_div_t" :id="'cr_t_'+index"></div>
                    <p class="validation_errors"></p>
                </div>
                <input type="hidden" :id="'cimg_'+index" name='cimg[]' value="">
                <input type="hidden" name="old_img[]" :value="oldImg">
            </div>
        </div>
    `,
    props: {
        baseUrl: String,
        index: Number,
        id: [String, Number],
        item: {
            type: String,
            default: undefined
        }
    },
    mounted(){
        window.addCroppic(this.baseUrl, 'cr_t_' + this.index, 'cimg_' + this.index, this.oldImg, true);
    },
    beforeDestroy(){
        if(!this.oldImg) {
            return;
        }
        $.post(
            '/goods/deleteajax',
            {
                'old_img': this.oldImg,
                'id': this.id
            },
            (is_delete) => {}, 'html');
    },
    computed: {
        oldImg(){
            if(this.item.length == 0){
                return undefined;
            }
            return this.item + this.index + '.jpeg';
        }
    }
});

Vue.component('FormImgContainer', {
    'template': `
    <div>
        <button class="btn btn-primary" @click.prevent="items.push('')">Добавить</button>
        <button class="btn btn-danger" @click.prevent="items.pop()">Удалить</button>
        <div id="img_items">
            <form-img v-for="(item, index) in items" :baseUrl="baseUrl" :key="index" :index="index" :item="item" :id="id"></form-img>
        </div>
    </div>
    `,
    data() {
        return {
            items: [],
        };
    },
    mounted() {
        for (let i = this.imgCount; i > 0; i--){
            this.items.push(this.imgPath);
        }
    },
    props: {
        baseUrl: String,
        id: [String, Number],
        imgCount: [Number, String],
        imgPath: String
    }
});

new Vue({
    el: '.goods_form',
    methods:{
        autoFill(){
            const title = this.$refs.title.value;
            this.$refs.description.setAttribute('value', title);
            this.$refs.keywords.setAttribute('value', title);
        },
    },
});