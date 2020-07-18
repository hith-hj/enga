<template>
    <div class="chaty">
        <div class="chatHead">
            <div style="text-transform: uppercase;">user name</div>
            <i class="fa fa-circle fa-xs like ml-1 mt-2 " v-if="online == true"></i>
            <i class="fa fa-circle fa-xs ml-1 mt-2" v-else></i>
            <span class="ml-1 mt-2 msg-date" v-if="typing == true">Typing...  </span>
        </div>
        <div class="chatBody" style="overflow-y:auto;">
            <div v-for="(msg, index) in msgs" :key="index">
                <div class="lmsg" v-if="msg.user_id != uid">
                    <div class="lmsg-content">                   
                        <span class="msg-date">{{msg.created_at | moment("H:m")}} {{msg.viewed == 2 ? '✓✓' : '✓' }} |</span>
                        {{msg.message}}
                    </div>
                </div>
                <div class="rmsg" v-else>
                    <div class="rmsg-content"> 
                        {{msg.message}}
                        <span class="msg-date">| {{msg.viewed == 2 ? '✓✓' : '✓' }} {{msg.created_at | moment("H:m")}}  </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="chatInput">            
            <input type="text" class="chat-input" placeholder="----" v-on:input="isTyping" v-on:keyup.enter="sendMsg" v-model="msgContent">
            <i class="fa fa-paper-plane chat-send"></i>            
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            online:false,
            typing:false,
            msgs:[],
            chan:{},
            msgContent:'',
            msg:{},
        }
    },
    props:{
        cid:Number,
        uid:Number,
        rid:Number,
    },
    created(){
        this.getMsgs();
        this.Channel();
    },
    updated() {
        this.Channel();
    },
    methods: {
        getMsgs(){
            axios.get(`/fetchMsgs/${this.cid}`).then((msgs)=>{
                this.msgs = msgs.data;
            });
        },
        Channel(){
            Echo.channel('chat'+this.cid)
            .listen('msg',(res)=>{
                this.getMsgs()
            });
            // }).here( (users)=>{
            //     console.log('here')
            //     this.online = true
            // }).joining( (user) => {
            //     console.log('joined');
            // }).leaving( (user) => {
            //     console.log('leaved');
            // }).listenForWhisper( 'typing',(e) =>{
            //     console.log('whispering');
            // });
        },
        sendMsg(){
            axios.post(`/sendMsg/${this.cid}/${this.msgContent}/${this.rid}`).then((res)=>{
                this.msgContent = ''
                // let msg={
                //     user_id : this.uid,
                //     message : this.msgContent,
                //     created_at : Date.now(),
                // }
                // this.msgs.push(msg);
            })        
        },
        isTyping(){
            // Echo.channel('chat'+this.cid)
            // .perform('typing', { sender: 'me!' });
            console.log('typeing')
        },
    },
}
</script>