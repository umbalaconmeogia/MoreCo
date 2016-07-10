package moreco.eas.evolable.asia.moreco.util;

import android.content.Context;
import android.net.ConnectivityManager;

/**
 * Created by PhanVanTrung on 2016/07/10.
 */
public class NetworkUtils {

    /**
     * check the internet access
     * @param context
     * @return
     */
    public static boolean isOnline(Context context) {
        ConnectivityManager cm =
                (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);

        return cm.getActiveNetworkInfo() != null &&
                cm.getActiveNetworkInfo().isConnectedOrConnecting();
    }
}
