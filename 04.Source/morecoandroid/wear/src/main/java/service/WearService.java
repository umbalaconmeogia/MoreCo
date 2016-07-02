package service;

import android.content.Intent;

import com.google.android.gms.wearable.DataEvent;
import com.google.android.gms.wearable.DataEventBuffer;
import com.google.android.gms.wearable.DataItem;
import com.google.android.gms.wearable.DataMap;
import com.google.android.gms.wearable.DataMapItem;
import com.google.android.gms.wearable.MessageEvent;
import com.google.android.gms.wearable.WearableListenerService;

import moreco.eas.evolable.asia.moreco.UpdateMessageActivity;

/**
 * Created by Phan Van Trung on 2016/06/26.
 */
public class WearService extends WearableListenerService {

    private static final String START_ACTIVITY_PATH = "/start/WearMainActivity";
    private static final String DATA_API_EXTRA_KEY = "DATA_API_EXTRA_KEY";
    private static final String DATA_API_PATH = "DATA_API_PATH ";
    private static final String TAG = "WearService";
    public static final String EXTRA_KEY_MESSAGE = "extra_key_message";


    @Override
    public void onMessageReceived(MessageEvent messageEvent) {
        super.onMessageReceived(messageEvent);

        if (START_ACTIVITY_PATH.equals(messageEvent.getPath())) {

            Intent intent = new Intent(this, UpdateMessageActivity.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            intent.putExtra(EXTRA_KEY_MESSAGE , new String(messageEvent.getData()));
            startActivity(intent);
            return;
        }
    }

    @Override
    public void onDataChanged(DataEventBuffer dataEvents) {
        for (DataEvent event : dataEvents) {
            DataItem dataItem = event.getDataItem();
            if (DATA_API_PATH.equals(dataItem.getUri().getPath())) {
                DataMap dataMap = DataMapItem.fromDataItem(dataItem).getDataMap();
                String message  = dataMap.getString(DATA_API_EXTRA_KEY);
                Intent intent = new Intent(this, UpdateMessageActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                intent.putExtra(EXTRA_KEY_MESSAGE , new String(message));
                startActivity(intent);
//
//                // android:allowEmbedded="true" is required for target activity
//                Intent intent = new Intent(this, NotificationEmbeddedActivity.class);
//                intent.putExtra(NotificationEmbeddedActivity.EXTRA_KEY_COUNT, count);
//                PendingIntent pendingIntent =
//                        PendingIntent.getActivity(this, 0, intent, PendingIntent.FLAG_CANCEL_CURRENT);
//
//                Notification notification = new Notification.Builder(this)
//                        .setSmallIcon(R.drawable.ic_launcher)
//                        .extend(
//                                new Notification.WearableExtender()
//                                        .setHintHideIcon(true)
//                                        .setDisplayIntent(pendingIntent)
//                        )
//                        .build();
//
//                NotificationManager notificationManager = (NotificationManager) getSystemService(NOTIFICATION_SERVICE);
//                notificationManager.notify(1000, notification);
//
//                break;
            }
        }
    }
}
