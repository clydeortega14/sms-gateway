<div class="left-sidebar" style="background-image: url('images/e2.jpg'); background-repeat: no-repeat;">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
             <ul id="sidebarnav">
                <li class="nav-devider"></li>


                 <!--DASHBOARD-->
                 <!--Superadmin Home-->
                  @if(auth()->user()->hasRole('superadmin'))
                    <li class="nav-label">SuperAdmin | Home</li>
                  @endif


                  <!--Admin Home-->
                  @if(auth()->user()->hasRole('admin'))
                    <li class="nav-label">Admin | Home</li>
                  @endif


                  <!--HeadOffice Home-->
                  @if(auth()->user()->hasRole('head_office'))
                    <li class="nav-label">Head Office | Home</li>
                  @endif


                  <!--Branch Home-->
                  @if(auth()->user()->hasRole('branch'))
                    <li class="nav-label">Branch | Home</li>
                  @endif

                    <li> <a class="has-arrow"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a>
                            <ul aria-expanded="false" class="collapse">
                              @if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin'))
                                  <li><a href="/dashboard"><i class="fa fa-home"></i> Home</a></li>
                              @elseif(auth()->user()->hasRole('head_office') || auth()->user()->hasRole('branch'))
                                @if(auth()->user()->information_id == null)

                                @else
                                  <li><a href="/head-office-dashboard"><i class="fa fa-home"></i> Home</a></li>
                                @endif
                              @endif

                            </ul>
                   </li>

                 <!--CREDENTIALS-->
                  @if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('head_office'))
                       <li class="nav-label">CREDENTIALS</li>
                       <li><a class="has-arrow"><i class="fa fa-suitcase"></i><span class="hide-menu">Clients</span></a>
                              <ul aria-expanded="false" class="collapse">
                                <!--SuperAdmin Access-->
                                @if(auth()->user()->hasRole('superadmin'))
                                  <li><a href="/create-accounts-credentials"><i class="fa fa-info-circle"></i> Accounts & Credentials</a></li>
                                  {{-- <li><a href="/create-client-access"><i class="fa fa-cogs"></i> Create Client Access</a></li> --}}
                                @endif
                                 @if(auth()->user()->hasRole('superadmin'))
                                  <li><a href="/payment"><i class="fa fa-money"></i> Create Payments</a></li>
                                  <li><a href="/view-credentials-details"><i class="fa fa-eye"></i> View Clients</a></li>
                                @endif

                                 @if(auth()->user()->hasRole('admin'))
                                  <li><a href="/receipt"><i class="fa fa-money"></i> Create Payments</a></li>
                                  <li><a href="/view-credentials-details"><i class="fa fa-eye"></i> View Clients</a></li>

                                @endif




                                <!--Main Office Access-->
                                @if(auth()->user()->hasRole('head_office'))
                                  @if(auth()->user()->information_id == null)

                                  @else
                                    <li><a href="/create-branch-access"><i class="fa fa-cogs"></i> Create Branch Account</a></li>
                                    <li><a href="/branch-details"><i class="fa fa-cogs"></i> View Branch Details</a></li>
                                  @endif
                                @endif
                              </ul>
                        </li>


                  @endif
                  @if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin'))
                       <li class="nav-label">CLIENT BILLS</li>
                       <li><a class="has-arrow"><i class="fa fa-info-circle"></i><span class="hide-menu">Bills</span></a>
                        <ul aria-expanded="false" class="collapse">
                          <li><a href="/clients-billing-statements"><i class="fa fa-cc-mastercard"></i> View Statements</a></li>
                        </ul>
                       </li>
                       @endif

                  <!--MESSAGES-->
                   @if(auth()->user()->hasRole('head_office') || auth()->user()->hasRole('branch'))
                   <li class="nav-label">Messages</li>
                   <li><a class="has-arrow"><i class="fa fa-credit-card"></i><span class="hide-menu">Messages</span></a>
                    <ul aria-expanded="false" class="collapse">
                      <li><a href="/sent-message"><i class="fa fa-envelope"></i> Sent</a></li>
                    </ul>
                  </li>
                   @endif


               <!--SUBSCRIPTION-->
               @if(auth()->user()->hasRole('head_office'))
                  @if(auth()->user()->information_id == null)

                  @elseif(auth()->user()->credentials->subscription == 2)
                  <li class="nav-label">Subscription</li>
                    <li><a class="has-arrow"><i class="fa fa-credit-card"></i><span class="hide-menu"> Subscription</span></a>
                      <ul aria-expanded="false" class="collapse">
                        <li><a href="/head-office-billing-history"><i class="fa fa-history"></i> Billing History</a></li>
                      </ul>
                    </li>
                  @endif
               @endif
            </ul>
        </nav>
    </div>
</div>
