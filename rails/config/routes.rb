Demo::Application.routes.draw do
  resources :users do
    collection do
      post :reset_password
      get :index
    end
  end
end
