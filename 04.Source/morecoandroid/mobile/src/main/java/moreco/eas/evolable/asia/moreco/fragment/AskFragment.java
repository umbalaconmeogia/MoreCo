package moreco.eas.evolable.asia.moreco.fragment;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import moreco.eas.evolable.asia.moreco.Constant;
import moreco.eas.evolable.asia.moreco.R;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class AskFragment extends Fragment {

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View rootView = inflater.inflate(R.layout.layout_ask_fragment, container, false);

        WebView webView = (WebView)rootView.findViewById(R.id.webview);

        webView.setInitialScale(1);
        webView.getSettings().setJavaScriptEnabled(true);
        webView.getSettings().setLoadWithOverviewMode(true);
        webView.getSettings().setUseWideViewPort(true);
        webView.setScrollBarStyle(WebView.SCROLLBARS_OUTSIDE_OVERLAY);
        webView.setScrollbarFadingEnabled(false);
        webView.setWebViewClient(new WebViewClient());
        webView.loadUrl(Constant.WEBVIEW_URL);

        return rootView;
    }
}
