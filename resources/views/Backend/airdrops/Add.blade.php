@extends('Backend.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            @if (count($errors) > 0)
                <div class="alert alert-error alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add AirDrops</h3>
                        </div>


<form id="validation2" action="{{route('saveAirdrop')}}" class="form-horizontal" enctype="multipart/form-data" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix"  style="max-height: 600px; overflow-y: auto;">
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Cryptocurrency Type <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <select type="text" name="cryptocurrency_type" data-placeholder="Select Type" class="validate[required] form-control select2" id="cat_name">
                
                    <option value=""></option>
                    <option value="Token">Token</option>
                    <option value="Coin">Coin</option>
                    <option value="NFTs">NFTs</option>
                   </select>
                
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Coin/ TOKEN Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="coin_token_name" class="validate[required] form-control" >
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Coin/TOKEN Symbol<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="coin_token_symbol" class="validate[required] form-control" >
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Start Date<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="start_date" class="validate[required] form-control datepicker" >
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">End Date<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="end_date" class="validate[required] form-control datepicker" >
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Winner Announcement Date<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="winner_announcement_date" class="validate[required] form-control datepicker" >
            </div>
        </div>

        
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Coin/ TOKEN Image * </label>
            <div class="col-sm-9">
                <small>Mix File size (Max:1MB))</small>, <small >File accept Only (jpeg,jpg png)</small>
                <input type="file"  id="image"  class="validate[required]] form-control" name="coin_token_image">
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Coin/ TOKEN Quantity: * (Number only)<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="number" name="coin_token_quantity" class="validate[required,number] form-control" >
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Total Airdrop Qty: * (Number only)<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="number" name="total_airdrop" class="validate[required] form-control" >
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">No of Winners: * (Number only)<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="number" name="no_of_winners" class="validate[required] form-control" >
            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Project Website: * (URL only)<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="url" name="project_website" class="validate[required] form-control" >
            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Email<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="email" class="validate[required,Email] form-control" >
            </div>
        </div>
      
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Description of Project:</label>
            <div class="col-sm-9">
                <textarea type="text" name="project_description" class="form-control summernote" rows="20" ></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Task Details</label>
            <div class="col-sm-9">
                <textarea type="text" name="task_details" class="form-control summernote" rows="5" ></textarea>
            </div>
        </div>
       

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Project Based On<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
    <select class="form-control select2" aria-label="project" data-placeholder="Please choose" id="project_based" name="project_based">
                    <option value=""></option>
                                      <option value="Binance-Smart-Chain">Binance-Smart-Chain</option>
                                      <option value="Ethereum">Ethereum</option>
                                      <option value="ABC">ABC</option>
                                      <option value="Collectibles-Nfts">Collectibles-Nfts</option>
                                      <option value="Cardano-Ecosystem">Cardano-Ecosystem</option>
                                      <option value="Play-To-Earn">Play-To-Earn</option>
                                      <option value="Interoperability">Interoperability</option>
                                      <option value="Coinbase-Ventures-Portofolio">Coinbase-Ventures-Portofolio</option>
                                      <option value="OKExChain">OKExChain</option>
                                      <option value="Gaming">Gaming</option>
                                      <option value="DeFi">DeFi</option>
                                      <option value="Solana Ecosystem">Solana Ecosystem</option>
                                      <option value="Others">Others</option>
                                      <option value="Animoca Brands Portfolio">Animoca Brands Portfolio</option>
                                      <option value="Staking">Staking</option>
                                      <option value="Quidd (Blockchain Service)">Quidd (Blockchain Service)</option>
                                      <option value="19">izumi Finance</option>
                                      <option value="izumi Finance">Solice</option>
                                      <option value="Calaxy">Calaxy</option>
                                      <option value="KingdomX">KingdomX</option>
                                      <option value="Air drops">Air drops</option>
                                      <option value="Terra">Terra</option>
                                      <option value="Klaytn">Klaytn</option>
                                      <option value="Polygon MATIC">Polygon MATIC</option>
                                      <option value="Arbitrum">Arbitrum</option>
                                      <option value="SUI">SUI</option>
                                      <option value="Avalanche">Avalanche</option>
                                      <option value="CIRX">CIRX</option>
                                      <option value="TRC20">TRC20</option>
                                      <option value="Multichain">Multichain</option>
                                      <option value="CratD2C Decentralized Autonomous Smart Chain">CratD2C Decentralized Autonomous Smart Chain</option>
                                      <option value="TON Network">TON Network</option>
                                      <option value="base">base</option>
                                      <option value="Coredao">Coredao</option>
                                   </select>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Country from Coin / Token Issued<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="country_name" class="validate[required] form-control" >
            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Task Link<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="url" name="task_link" class="validate[required] form-control" >
            </div>
        </div>


    
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Facebook URL <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="url" name="facebook_url" class="validate[required] form-control" >
            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Twitter URL <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="url" name="twitter_account" class="validate[required] form-control" >
            </div>
        </div>


        
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Instagram URL <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="url" name="instagram_url" class="validate[required] form-control" >
            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Reddit URL <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="url" name="reddit_url" class="validate[required] form-control" >
            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Medium URL <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="url" name="medium_url" class="validate[required] form-control" >
            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Telegram URL <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="url" name="telegram_url" class="validate[required] form-control" >
            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Discord URL <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="url" name="discord_url" class="validate[required] form-control" >
            </div>
        </div>


    
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Contract Address <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="contract_address" class="validate[required] form-control" >
            </div>
        </div>

        <h3>User Contact info:</h3>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Choose Contact Type <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <select class="form-control select2" aria-label="contact-type" data-placeholder="Choose Contact Type" id="contact-type" name="user_contact_type">
                    <option value=""></option>
                    <option value="whatsapp">Whatsapp Number</option>
                    <option value="Telegram">Telegram Id</option>
                 </select>
            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Enter Here <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="contact_id" class="validate[required] form-control" >
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat"><span class="fa fa-close"></span> Close</button>
        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>
    </div>
</form>

</div>
</div>
</div>

</section>
</div>

@endsection

@push('script')
    

<script type="text/javascript">
jQuery("#validation2").validationEngine({promptPosition: 'inline'});

$('.datepicker').datepicker({
        autoclose: true,
        // format: "yyyy-mm-dd",
        format: "mm-dd-yyyy"
      
    })


</script>











<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            tabsize: 2,
            height: 200
        });

    });
</script>

<script type="text/javascript">
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});
    $('.select2').select2();

</script>

@endpush